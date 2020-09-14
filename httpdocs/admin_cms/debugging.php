<?php
echo '<h3>Debugging Info Section:</h3>';
if (isset($id_now)) {
    echo '
      <p>$id_now = ' . $id_now . ' </p>
      <hr />';
}

if (isset($query_builder1)) {
    echo   '<p>$query_builder1:</p> ' . $query_builder1 . ' </p>     
      <hr />';
}
if (isset($json_result1)) {
      echo '<p>Current json_results1: ' . $json_result1 . ' </p>;
        <hr />';
}

if (isset($query_builder2)) {
    echo '<p>$query_builder2: ' . $query_builder2 . ' </p>     
      <hr />';
}
if (isset($query_builder2_update)) {
echo '  <p>Query 2_update: ' . $query_builder2_update . '</p>        
      <hr />';
}
if (isset($query_builder2_insert)) {
    echo '  <p>Query 2_insert: ' . $query_builder2_insert . '</p>          
      <hr />      ';
}
if (isset($json_result2)) {
      echo '<pre>Current json_results2: ' . $json_result2 . ' </pre>;
        <hr />';
}

if (isset($query_builder3)) {
    echo '  <p>$query_builder3:</p>  <pre><pre>' . $query_builder3 . ' </pre></pre>    
      <hr />      ';
}
if (isset($json_result3)) {
      echo '<pre><pre>Current json_results3: ' . $json_result3 . ' </pre></pre>;
        <hr />';
}

if (isset($_GET['id'])) {
    echo '  <p>In Array Function: ' . in_array($_GET['id'], $_SESSION['content_array'], true) . ' </p>                      
      <hr />      ';
}

if (isset($id_now) && isset($_GET['id'])) {
    echo '  <p>Current Array record:</p>  <pre><pre>';
    print_r($_SESSION['content_array'][$id_now]);
    echo' </pre></pre>    
      <hr />';
}

echo '<hr /><hr /><hr />';
echo '<p>Complete Array dump:</p> <pre><pre>';
print_r($_SESSION['content_array']);
echo ' </pre></pre>
      <hr />';
?>