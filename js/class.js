// Declare app level module which depends on filters, and services
var FavoriteApp = angular.module('FavoriteApp', []);


FavoriteApp.controller('FavoriteCtr', function ($scope) {

    $scope.countTo = 1000;
    $scope.countFrom = 0;
    $scope.titler = "이정훈느님만세";
  //  $scope.API_add_api_description = "has-error";
       $scope.setContent = function ($count) {

  


    };

    $scope.setAPIDescriptionError = function () {
        $scope.API_add_api_description = 'has-error';
         };

    // $scope.reCount = function () {
    //     $scope.countFrom = Math.ceil(Math.random() * 300);
    //     $scope.countTo = Math.ceil(Math.random() * 7000) - Math.ceil(Math.random() * 600);
    // };

});

function mainCtrl($scope) {
  $scope.name = 'Default Name';
};

function setAPIDescriptionError($scope) {
    $scope.API_add_api_description = 'has-error';
};


function document_write($scope, $http, transformRequestAsFormPost) {

                // I hold the data-dump of the FORM scope from the server-side.
                $scope.cfdump = "";
 
                // By default, the $http service will transform the outgoing request by
                // serializing the data as JSON and then posting it with the content-
                // type, "application/json". When we want to post the value as a FORM
                // post, we need to change the serialization algorithm and post the data
                // with the content-type, "application/x-www-form-urlencoded".
                var request = $http({
                    method: "post",
                    url: "board/document_app_write.php",
                    transformRequest: transformRequestAsFormPost,
                    data: {
                    	authcode: 642979,
                        kind: 1,
                         page_srl: 1,
                         content: "I LOVE YOU"
                    }
                });
 
                // Store the data-dump of the FORM scope.
                request.success(
                    function( html ) {
 
                        $scope.cfdump = html;
 
                    }
                );
};


// I provide a request-transformation method that is used to prepare the outgoing
        // request as a FORM post instead of a JSON packet.
        app.factory(
            "transformRequestAsFormPost",
            function() {
 
                // I prepare the request data for the form post.
                function transformRequest( data, getHeaders ) {
 
                    var headers = getHeaders();
 
                    headers[ "Content-type" ] = "application/x-www-form-urlencoded; charset=utf-8";
 
                    return( serializeData( data ) );
 
                }
 
 
                // Return the factory value.
                return( transformRequest );
 
 
                // ---
                // PRVIATE METHODS.
                // ---
 
 
                // I serialize the given Object into a key-value pair string. This
                // method expects an object and will default to the toString() method.
                // --
                // NOTE: This is an atered version of the jQuery.param() method which
                // will serialize a data collection for Form posting.
                // --
                // https://github.com/jquery/jquery/blob/master/src/serialize.js#L45
                function serializeData( data ) {
 
                    // If this is not an object, defer to native stringification.
                    if ( ! angular.isObject( data ) ) {
 
                        return( ( data == null ) ? "" : data.toString() );
 
                    }
 
                    var buffer = [];
 
                    // Serialize each key in the object.
                    for ( var name in data ) {
 
                        if ( ! data.hasOwnProperty( name ) ) {
 
                            continue;
 
                        }
 
                        var value = data[ name ];
 
                        buffer.push(
                            encodeURIComponent( name ) +
                            "=" +
                            encodeURIComponent( ( value == null ) ? "" : value )
                        );
 
                    }
 
                    // Serialize the buffer and clean it up for transportation.
                    var source = buffer
                        .join( "&" )
                        .replace( /%20/g, "+" )
                    ;
 
                    return( source );
 
                }
 
            }
        );
 
 
        // -------------------------------------------------- //
        // -------------------------------------------------- //
 
 
        // I override the "expected" $sanitize service to simply allow the HTML to be
        // output for the current demo.
        // --
        // NOTE: Do not use this version in production!! This is for development only.
        app.value(
            "$sanitize",
            function( html ) {
 
                return( html );
 
            }
        );


