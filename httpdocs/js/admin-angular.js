(function(){
    var app = angular.module('admin-console', []);
    
    app.controller('AdminController', function(){
        this.pages = content;
    });
    
    app.controller('PanelController', function(){
        this.tab = 'ShowAll';
        
        this.selectTab = function(setTab) {
            this.tab = setTab;
        };
        
        this.isSelected = function(checkTab) {
            return this.tab === checkTab;
        };
    });

    var content = '';
    $.ajax({
        url: '../includes/data_functions.php',
        data: {action: 'getPagesData'},
        type: 'post',
        // success: function(output) {
        //     alert(output);
        //     context = data;
        //     alert(data);
        // }       
        success: function(data) {
            context = data;
        }               
    });
    
//    app.controller('ReviewController', function(){
//        this.review = {};
//        
//        this.addReview = function(product) {
//            console.info('product.reviews before array push',product.reviews);
//            product.reviews.push(this.review);
//            this.review = {};
//        };
//    });
//    
//    var content = [
//        {
//            name : 'Pending Content 1', 
//            price: 2.95,
//            description: 'Pending Content that needs your approval for Production use',
//            specification: 'Pending Content',
//            images: [
//                {
//                    full: '../images/gem-01.gif',
//                    thumb: '../images/gem-01.gif'
//                }
//            ],
//            content_id: 97,
//            status: 'pending',
//            type: 'article',
//            title: 'TEST',
//            thumbnail: '',
//            author: 'admin',
//            date: '01-17-14 07:37:49 pm',
//            formatted_content: ''
//        },
//        {
//            name : 'Pending Content 2', 
//            price: 2.95,
//            description: 'Pending Content that needs your approval for Production use',
//            specification: 'Pending Content',
//            images: [
//                {
//                    full: '../images/gem-01.gif',
//                    thumb: '../images/gem-01.gif'
//                }
//            ],
//            content_id: 96,
//            status: 'live',
//            type: 'article',
//            title: 'TEST',
//            thumbnail: '',
//            author: 'admin',
//            date: '01-17-14 07:37:49 pm',
//            formatted_content: ''
//        },
//        {
//            name : 'Pending Content 3', 
//            price: 2.95,
//            description: 'Pending Content that needs your approval for Production use',
//            specification: 'Pending Content',
//            images: [
//                {
//                    full: '../images/gem-01.gif',
//                    thumb: '../images/gem-01.gif'
//                }
//            ],
//            content_id: 95,
//            status: 'pending',
//            type: 'video',
//            title: 'TEST',
//            thumbnail: '',
//            author: 'video',
//            date: '01-17-14 07:37:49 pm',
//            formatted_content: ''
//        }
//    ];
    

})();
