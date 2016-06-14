var appControllers = angular.module('appControllers', []);
var domain = 'http://mobile.unpar.ac.id/apps/frontend/index.php/v3';
var fullMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

appControllers.controller('HomeController', ['$scope' , '$routeParams', '$http', '$sce',
	function($scope,$routeParams,$http,$sce){
		$scope.loading=true;
		$http.get(domain + '/news?tipe=0').success(function(data, status, headers, config){
			$scope.homeNewsData=data;
		});
		$http.get(domain + '/news?tipe=1').success(function(data, status, headers, config){
			$scope.homeBeasiswaData=data;
			$scope.loading=false;
		});
		$http.get(domain + '/events').success(function(data, status, headers, config){
			$scope.homeEventData=data;
			$scope.loading=false;
		});

		changeTitleHeader('Unpar Apps');
	}
]);

appControllers.controller('EventController', ['$scope' , '$routeParams', '$http', '$sce',
	function($scope,$routeParams,$http,$sce){
		$scope.loading=true;

		$scope.busy = false;

		$http.get(domain + '/events').success(function(data, status, headers, config){
			$scope.eventsData=data;
			$scope.loading=false;
		});

		var page = 1;
		$scope.myPagingFunction = function(){
			if (this.busy) return;
			$scope.busy = true;
			$http.get(domain + '/events?page='+page).success(function(data,status,headers,config){
				if(headers('X-Pagination-Page-Count') < page){
					$scope.busy = false;
					return;
				}
				console.log(headers('link'));
					for (var i = 0; i < data.length; i++) {
						if($scope.eventsData.length >= 1){
							//console.log($scope.eventsData.content);
							if ($scope.eventsData.content != undefined && $scope.eventsData.content != null && $scope.eventsData.content != "") {
								$scope.eventsData.push(data[i]);
							}
						}
					}
					$scope.loading = false;
					$scope.busy = false;
					page++;
			});
		}

		changeTitleHeader('Events');
	}
]);

appControllers.controller('EventDetailsController', ['$scope', '$routeParams', '$http',
		function($scope,$routeParams,$http){
			$scope.loading = true;
			$http.get(domain + '/events/'+ $routeParams.id).success(function(data){
				$scope.eventData = data;
				$scope.loading = false;
			});

            changeTitleHeader('Events');
		}
]);


var x;
appControllers.controller('AspirasiController',['$scope','$http','$routeParams', function($scope,$http,$routeParams){
		closeAspirasiBox();
		$scope.submitAspiration = function(){
				$scope.loading = true;
				var name = $scope.form.name;
	      		var content = $scope.form.content;
				var img_base64 = $("#img_base64").val();

				if(content == undefined || content == ""){
						alert("content harus diisi");
				}else {
						$.ajax({
							url: domain + '/aspirations',
							method: 'POST',
							data: {
								content: content,
								name: name,
								img_base64: img_base64
							},
							success: function(response){
								$scope.loading = false;
								alert('Aspirasi sudah terkirim!');
							},
							error: function(xhr, status, error){
								$scope.loading = false;
								alert(error);
							},
							complete: function(){
								document.location.reload();
							}
						})
				}
		}

		$scope.thumbsup = function(id_aspirasi){
			var code = $scope.code;
			// var status = $scope.status;
			$.ajax({
				url: domain + '/thumbs',
				method: 'POST',
				data: {
					id_aspirasi: id_aspirasi,
					code: regId,
					status: 1
				},
				success: function(response){
					// window.location.reload();
					$(this).addClass('text-success');
				},
				error: function(xhr, status, error){
				},
				complete: function(){
					document.location.reload();
				}
			})
		}

		$scope.thumbsdown = function(id_aspirasi){
			var code = $scope.code;
			// var status = $scope.status;

			$.ajax({
				url: domain + '/thumbs',
				method: 'POST',
				data: {
					id_aspirasi: id_aspirasi,
					code: regId,
					status: 0
				},
				success: function(response){
					// window.location.reload();
					$(this).addClass('text-danger');
				},
				error: function(xhr, status, error){
				},
				complete: function(){
				   document.location.reload();
				}
			})
		}

		$scope.busy = false;

		$scope.backLinkClick = function () {
  		window.location.reload();
		};

		$http.get(domain + '/aspirations').success(function(data){
				$scope.aspiration=data;
				x = data;
				$scope.loading = false;
		});

		var page = 1;
		$scope.myPagingFunction = function(){
			if (this.busy) return;
			$scope.busy = true;
			$http.get(domain + '/aspiration?page='+page).success(function(data,status,headers,config){
				// console.log('distras testing');
				if(headers('X-Pagination-Page-Count') < page){
					// console.log('headers: '+headers('X-Pagination-Page-Count'));
					// console.log('page: '+page);
					$scope.busy = false;
					return;
				}
				console.log(headers('link'));
					for (var i = 0; i < data.length; i++) {
						if ($scope.aspiration.length >= 1) {
							if ($scope.aspiration.content != undefined && $scope.aspiration.content != null && $scope.aspiration.content != "") {
								console.log("undefined? "+$scope.aspiration.content);
								$scope.aspiration.push(data[i]);
							}
						}
					}
					$scope.loading = false;
					$scope.busy = false;
					page++;
			});
		}

		changeTitleHeader('Aspirasi');
}]);

appControllers.controller('NewsController', ['$scope' , '$routeParams', '$http', '$sce',
	function($scope, $routeParams, $http, $sce){
        $scope.loading = true;
		$http.get(domain + '/news?tipe=0?page=' + $routeParams.currentPage).success(function(data, status, headers, config){
			$scope.newsData = data;
            $scope.currentPage = parseInt(headers('x-pagination-current-page'));
            $scope.nextPage = $scope.currentPage + 1;
            $scope.prevPage = $scope.currentPage - 1;
            $scope.maxPage = parseInt(headers('X-Pagination-Page-Count'));

            //view as html
            $scope.loading = false;

            loadImage();
		});

        changeTitleHeader('News');
	}
]);

appControllers.controller('NewsDetailController', ['$scope', '$routeParams', '$http',
		function($scope,$routeParams,$http){
			$scope.loading = true;
			$http.get(domain + '/news/'+ $routeParams.id).success(function(data){
				$scope.newsData = data;
				$scope.loading = false;
			});
            changeTitleHeader('News');
		}
	]);

	appControllers.controller('BeasiswaController', ['$scope' , '$routeParams', '$http', '$sce',
		function($scope, $routeParams, $http, $sce){
	        $scope.loading = true;
			$http.get(domain + '/news?tipe=1?page=' + $routeParams.currentPage).success(function(data, status, headers, config){
				$scope.newsDataBeasiswa = data;
	            $scope.currentPage = parseInt(headers('x-pagination-current-page'));
	            $scope.nextPage = $scope.currentPage + 1;
	            $scope.prevPage = $scope.currentPage - 1;
	            $scope.maxPage = parseInt(headers('X-Pagination-Page-Count'));

	            //view as html
	            $scope.loading = false;

	            loadImage();
			});

	        changeTitleHeader('Beasiswa');
		}
	]);

appControllers.controller('BeasiswaDetailController', ['$scope', '$routeParams', '$http',
	function($scope,$routeParams,$http){
		$scope.loading = true;
		$http.get(domain + '/news/'+ $routeParams.id).success(function(data){
			$scope.beasiswaData = data;
			$scope.loading = false;
		});
		changeTitleHeader('Beasiswa');
	}
]);

appControllers.controller('DirectoryController', ['$scope', '$routeParams', '$http',
	function($scope, $routeParams, $http){
		$scope.loading = true;
		$http.get(domain + '/categories').success(function(data){
			$scope.directoryData=data;
			$scope.loading = false;
		});
        changeTitleHeader('Direktori');
	}
]);

appControllers.controller('DirectoryListController', ['$scope', '$routeParams', '$http',
	function($scope, $routeParams, $http){
		$scope.loading = true;
		$http.get(domain + '/directories?page=' + $routeParams.currentPage + '&category_id=' + $routeParams.category_id).success(function(data, status, headers, config){
			$scope.categoryId = parseInt($routeParams.category_id);
			$scope.currentPage = parseInt(headers('x-pagination-current-page'));
            $scope.nextPage = $scope.currentPage + 1;
            $scope.prevPage = $scope.currentPage - 1;
            $scope.maxPage = parseInt(headers('X-Pagination-Page-Count'));
			$scope.directoryCategoryData=data;

			$scope.loading = false;
		});
		$http.get(domain + '/categories/' + $routeParams.category_id).success(function(data){
			$scope.category = data;
		});
        changeTitleHeader('Direktori');
	}
]);

appControllers.controller('DirectoryDetailsController', ['$scope', '$routeParams', '$http',
	function($scope, $routeParams, $http){
		$scope.loading = true;
		$http.get(domain + '/directories/' + $routeParams.id).success(function(data){
			$scope.directoryDetailsData=data;
			$scope.loading = false;
		});
        changeTitleHeader('Direktori');
	}
]);

appControllers.controller('CalendarController', ['$scope' , '$routeParams' , '$http' ,
	function($scope, $routeParams, $http){
		$scope.loading = true;
		$scope.fullMonths=fullMonths;
		$scope.months=months;
        $scope.today=new Date();
		$http.get(domain + '/calendars').success(function(data){
			$scope.calendarData=data;
			$scope.loading = false;
		});
        changeTitleHeader('Kalender');
	}
]);

appControllers.controller('StudentPortalController', ['$scope', '$http',
    function($scope, $http){

	}
]);

appControllers.controller('KontakBiroController',['$scope','$http',
    function($scope,$http){
        $http.get('assets/js/JSON/kontak-biro.json').success(function(data){
            $scope.contactBiro=data;
            $scope.loading = false;
        });
        changeTitleHeader('Kontak Biro');
    }
]);

appControllers.controller('AboutController',['$scope','$http',
    function($scope,$http){
        $http.get('assets/js/JSON/about-us.json').success(function(data){
            $scope.about=data;
            $scope.loading = false;
        });
        changeTitleHeader('About Us');
    }
]);

appControllers.controller('JadwalToeflController', ['$scope', '$routeParams', '$http',
	function($scope, $routeParams, $http){
		$scope.loading = true;
		$http.get('http://cdc.unpar.ac.id/webservice/jadwal_toefl.php').success(function(data){
			$scope.jadwalToefl=data;
			$scope.loading = false;
		});
        changeTitleHeader('Jadwal TOEFL');
	}]);

appControllers.controller('CekNilaiToeflController', ['$scope', '$http',
	function($scope, $http){
		changeTitleHeader('Cek Nilai TOEFL');
		$scope.click=function(){
			$http({
				method: "POST",
				url: "http://cdc.unpar.ac.id/webservice/ceknilai.php",
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
				},
				data: $.param({
					npm:$scope.export
				})
			}).success(function(data,status,header,config){
				$scope.panjang = data.length;
				$scope.toefldata = data;
			}).error(function(data,status,header,config){
				console.log(status);
			});
		}
	}
]);
