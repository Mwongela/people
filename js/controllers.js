angular.module('busara.controllers', [])

  .controller('AppCtrl', function($scope, $http) {

    $scope.persons = [];
    $scope.error = "";
    $scope.loading = false;

    $scope.newPerson = {
      name: "",
      age: "",
      phoneNumber: ""
    };

    $scope.addNewPerson = function() {

      var name = this.newPerson.name;
      var age = this.newPerson.age;
      var phoneNumber = this.newPerson.phoneNumber;

      if(name !== "" && age !== "" || phoneNumber != "") {

        $scope.error = "";
        $scope.loading = true;

          $http({
          method: 'POST',
          url: 'api/index.php',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          transformRequest: function(obj) {
            var str = [];
            for(var p in obj)
            str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            return str.join("&");
        },
        data: {
          action: 'add_person',
          name: name,
          age: age,
          phoneNumber: phoneNumber
        }
        }).success(function(response) {

          $scope.loading = false;

          if(response.success === 1) {

            $scope.newPerson['name'] = "";
            $scope.newPerson['age']  = "";
            $scope.newPerson['phoneNumber'] = "";

            $scope.persons[$scope.persons.length] = {
              name: name,
              age: age,
              phoneNumber: phoneNumber,
              id: response.id
            };

          } else {
            $scope.error = response.message;
          }

        }).error(function(response) {

          $scope.error = "An error occured. Please try again";
          $scope.loading = false;

        });

      } else {
        $scope.error = "Please check your input";
      }

      

    }

    $http({
        method : "GET",
        url : "api/index.php?action=get_all_persons"

      }).then(function success(response) {
          response = response.data;
          if(response.success === 1) {
            $scope.persons = response.persons;
          }

      }, function error(response) {
          console.error("Error occured");
      });


  });
