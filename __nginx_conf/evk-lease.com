# evk-lease.com domain configuration - SSL(:443) with reverse proxy to Apache(:8080) in upstream template
upstream upstream-28.evk-lease.com {
#    server 28.evk-lease.com:8080; 
    server 172.20.0.2:8080; 
#See: http://nginx.org/en/docs/http/ngx_http_upstream_module.html#upstream
#    server unix:/var/www/vhosts/dmrcly/evk-lease.com/httpdocs;
}

# Redirect all traffic to port 80 (non-SSL) to port 443 (SSL) #redirect to www, always
server {
    listen 80; 
    server_name 28.evk-lease.com; 
#    return 301 https://www.$host$request_uri;
    return 301 https://28.evk-lease.com$request_uri;
}


#redirect to www, always, even on https://(:443)
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name    evk-lease.com ;
    ssl_certificate    /var/www/vhosts/dmrcly/evk-lease.com/ssl/evk-lease.com-tld-cert-cloudflare-bundled-ecdsa-origin_ca_ecc_root.pem;
    ssl_certificate_key    /var/www/vhosts/dmrcly/evk-lease.com/ssl/evk-lease.com-tld-key.pem;
    ssl_trusted_certificate    /var/www/vhosts/dmrcly/evk-lease.com/ssl/cloudflare-bundled-ecdsa-origin_ca_ecc_root.pem; # (eg /etc/nginx/ssl/fullchain.pem; || /path/to/root_CA_cert_plus_intermediates;)
#    resolver 104.27.147.179; # Find Cloudflare Resolver IP -> https://shadowcrypt.net/tools/cloudflare
    resolver 127.0.0.1;
#    return 301 https://www.$host$request_uri;
    return 301 https://28.evk-lease.com$request_uri;
}

#primary server directive
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;

    server_name    28.evk-lease.com ;

    #Log files configs & locations
    access_log    /var/log/nginx/evk-lease.com.access.log;
    error_log    /var/log/nginx/evk-lease.com.error.log;

    #Site DocumentRoot, Index & settings
    root    /var/www/vhosts/dmrcly/evk-lease.com/httpdocs;
    index    index.php    index.html    index.htm;  
    client_max_body_size    20M;

##### BEGIN error handling
    location  /error-pages/ {
        internal;
    }
#    error_page 404 = /error-pages/404-page-not-found.php;
#    error_page 403 = /error-pages/403-forbidden.php;
#    error_page 500 502 503 504 = /error-pages/500-internal-server-error.php;
#    error_page 500 502 503 504 /50x.html;  
    location = /50x.html { 
        root    /var/www/html; 
    }  
##### END error handling

##### W3 Total Cache - configuration file path #uncomment to enable
#    include /path/to/wordpress/installation/nginx.conf;

### allows for tools that use directories or config files (eg: Let's Encrypt) that use this directory (in a required & legitimate way)
    location ~ ^/\.well-known\._others { 
        allow all;
    }

### protect xmlrpc.php from attacks
    location /xmlrpc.php {
        deny all;
    }

    location / {
        try_files $uri @apache;
    }

    location ~ ^/\.user\.ini {
        deny all;
    }

    location ~*  \.(svg|svgz)$ {
        types {}
        default_type image/svg+xml;
    }

    location = /favicon.ico {
        log_not_found off;
        access_log off;
    }

    location = /robots.txt {
        allow all;
        log_not_found off;
        access_log off;
    }

    location @apache {
        proxy_set_header X-Real-IP  $remote_addr;
        proxy_set_header X-Forwarded-For $remote_addr;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header Host $host;
#        proxy_pass http://upstream-evk-lease.com$uri; # USE HTTP for Apache(:8080) Reverse Proxy!
#        proxy_pass http://upstream-$host$uri; # USE HTTP for Apache(:8080) Reverse Proxy!
        proxy_pass http://upstream-$host$uri$is_args$args; # IMPORTANT: $is_args$args; Use HTTP for Apache(:8080) Reverse Proxy! ( https://wordpress.stackexchange.com/a/283101 )
    }

    location ~[^?]*/$ {
        proxy_set_header X-Real-IP  $remote_addr;
        proxy_set_header X-Forwarded-For $remote_addr;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header Host $host;
#        proxy_pass http://upstream-evk-lease.com$uri; # USE HTTP for Apache(:8080) Reverse Proxy!
#        proxy_pass http://upstream-$host$uri; # USE HTTP for Apache(:8080) Reverse Proxy!
        proxy_pass http://upstream-$host$uri$is_args$args; # IMPORTANT: $is_args$args; Use HTTP for Apache(:8080) Reverse Proxy! ( https://wordpress.stackexchange.com/a/283101 )
    }

    location ~ \.php$ {
        proxy_set_header X-Real-IP  $remote_addr;
        proxy_set_header X-Forwarded-For $remote_addr;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header Host $host;
#        proxy_pass http://upstream-evk-lease.com$uri?$args; # IMPORTANT: ?$args; Use HTTP for Apache(:8080) Reverse Proxy!
#        proxy_pass http://upstream-$host$uri?$args; # IMPORTANT: ?$args; Use HTTP for Apache(:8080) Reverse Proxy!
        proxy_pass http://upstream-$host$uri$is_args$args; # IMPORTANT: $is_args$args; Use HTTP for Apache(:8080) Reverse Proxy! ( https://wordpress.stackexchange.com/a/283101 )
    }

    location ~/\. {
        deny all;
        access_log off;
        log_not_found off;
    }


##### BEGIN SSL Configuration for evk-lease.com (See /etc/nginx/nginx.conf SSL block for Shared Config settings)
    ssl_certificate    /var/www/vhosts/dmrcly/evk-lease.com/ssl/evk-lease.com-tld-cert-cloudflare-bundled-ecdsa-origin_ca_ecc_root.pem; # Cloudflare Universal SSL Cert 
    ssl_certificate_key    /var/www/vhosts/dmrcly/evk-lease.com/ssl/evk-lease.com-tld-key.pem; # Cloudflare Universal SSL Key

### SSL Sessions Settings
    ssl_session_timeout 1d;
# IMPORTANT: using $host variable in 'ssl_session_cache' for the domain / subdomain that is in use (this is compatible with dynamic multi-domain & single domain configurations)  
    ssl_session_cache shared:$host-session-cache-SSL:10m;  # 10m = about 40000 sessions, shared(caching type):domain.name(cache name):XXsmhdMY(cache timer)
#    ssl_session_tickets off;

### DH params options
#    ssl_dhparam /etc/ssl/dhparam.pem; # (`openssl dhparam -out /etc/ssl/dhparam.pem 4096`)
    ssl_dhparam /var/www/vhosts/dmrcly/evk-lease.com/ssl/dhparam.pem;

### SSL Protocols & Ciphers (TLSv1.3 most secure; SSLv3, TLSv1 and TLSv1.1 are depricated)
# Most Secure with TLSv1.3 ONLY (lease backwards compatible) # Use with Cloudflare Proxy for better security
    ssl_protocols TLSv1.3;
    ssl_ecdh_curve X25519:P-256:P-384:P-224:P-521; #untested
    ssl_prefer_server_ciphers on;

### SSL Security Settings 
### HSTS ("max-age=63072000" option is in seconds) # SEVERE Consequences for disabled SSL per domain before this cache expires! see here: https://support.cloudflare.com/hc/en-us/articles/204183088-Understanding-HSTS-HTTP-Strict-Transport-Security
#    add_header    Strict-Transport-Security  "max-age=31536000  includeSubDomains"  always; # includeSubDomains "is in options"
### OCSP stapling 
    ssl_stapling on;
    ssl_stapling_verify on; 
    ssl_stapling_file /var/www/vhosts/dmrcly/evk-lease.com/ssl/evk-lease.com_cloudflare_ocsp.resp; # https://gist.github.com/fh/7444667
    ssl_stapling_responder http://ocsp.cloudflare.com/origin_ecc_ca;
#    ssl_trusted_certificate    /etc/nginx/ssl/cloudflare-bundled-ecdsa-origin_ca_ecc_root.pem; # (eg /etc/nginx/ssl/fullchain.pem; || /path/to/root_CA_cert_plus_intermediates;)
    ssl_trusted_certificate    /var/www/vhosts/dmrcly/evk-lease.com/ssl/cloudflare-bundled-ecdsa-origin_ca_ecc_root.pem; # (eg /etc/nginx/ssl/fullchain.pem; || /path/to/root_CA_cert_plus_intermediates;)
#    resolver 104.27.147.179; # Find Cloudflare Resolver IP -> https://shadowcrypt.net/tools/cloudflare
    resolver 127.0.0.1;
##### END SSL Configuration for evk-lease.com 



}
