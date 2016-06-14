var unparApp = angular.module('unparApp', [
    'ngRoute',
    'appControllers',
    'ngSanitize',
    'angulartics',
    'angulartics.google.analytics.cordova',
    'infinite-scroll'
]);

unparApp.config(['$routeProvider',
    function($routeProvider){
        $routeProvider.
        when('/home', {
            'templateUrl': 'partials/home.html',
            'controller': 'HomeController'
        }).
        when('/aspirasi', {
			'templateUrl': 'partials/aspirasi.html',
			'controller': 'AspirasiController'
		}).
        when('/news', {
			'templateUrl': 'partials/news.html',
			'controller': 'NewsController'
		}).
        when('/events', {
			'templateUrl': 'partials/events.html',
			'controller': 'EventController'
		}).
		when('/events-details/:id', {
			'templateUrl': 'partials/events-details.html',
			'controller': 'EventDetailsController'
		}).
        when('/home-events-details/:id', {
			'templateUrl': 'partials/home-events-details.html',
			'controller': 'EventDetailsController'
		}).
        when('/beasiswa',{
          'templateUrl':'partials/beasiswa.html',
          'controller':'BeasiswaController'
        }).
        when('/beasiswa-details/:id',{
          'templateUrl':'partials/beasiswa-details.html',
          'controller':'BeasiswaDetailController'
        }).
        when('/home-beasiswa-details/:id',{
          'templateUrl':'partials/home-beasiswa-details.html',
          'controller':'BeasiswaDetailController'
        }).
        when('/about-us', {
            'templateUrl': 'partials/about-us.html',
            'controller': 'AboutController'
        }).
        when('/news/:currentPage', {
			'templateUrl': 'partials/news.html',
			'controller': 'NewsController'
		}).
        when('/news-detail/:id', {
			'templateUrl':'partials/news-detail.html',
			'controller': 'NewsDetailController'
		}).
        when('/home-news-detail/:id', {
			'templateUrl':'partials/home-news-detail.html',
			'controller': 'NewsDetailController'
		}).
		when('/directory', {
			'templateUrl': 'partials/directory.html',
			'controller' : 'DirectoryController'
		}).
		when('/directory-list/:category_id', {
			'templateUrl' : 'partials/directory-list.html',
			'controller' : 'DirectoryListController'
		}).
		when('/directory-list/:category_id/:currentPage', {
			'templateUrl' : 'partials/directory-list.html',
			'controller' : 'DirectoryListController'
		}).
		when('/directory-details/:id', {
			'templateUrl' : 'partials/directory-details.html',
			'controller' : 'DirectoryDetailsController'
		}).
		when('/kalendar' , {
			'templateUrl' : 'partials/calendar.html' ,
			'controller' : 'CalendarController'
		}).
        when('/kontak-biro', {
            'templateUrl': 'partials/kontak-biro.html',
            'controller': 'KontakBiroController'
        }).
        when('/jadwal-toefl', {
            'templateUrl': 'partials/jadwal-toefl.html',
            'controller': 'JadwalToeflController'
        }).
        when('/ceknilaitoefl', {
            'templateUrl': 'partials/ceknilaitoefl.html',
            'controller': 'CekNilaiToeflController'
        }).
        otherwise({
            'redirectTo': '/home'
        });
    }]);
