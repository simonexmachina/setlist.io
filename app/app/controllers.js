'use strict';

/* Controllers */

var mod = {}

/**
 * Controller for the Settings panel. Handles changing the theme.
 */
mod.SettingsCtrl = [
'$scope', '$rootScope', 'config',
function( $scope, $rootScope, config ) {
  $scope.themes = [
    {id: 'helvetica', name: 'Helvetica'},
    {id: 'futura', name: 'Futura'},
    {id: 'orbitron', name: 'Orbitron'},
    {id: 'lithos-pro', name: 'Lithos Pro'},
    {id: 'hotel-solid', name: 'Hotel Solid'},
    {id: 'mostra-nuova-alt-c', name: 'Mostra Nuova Alt C'}
  ];
  // store the selected theme in the scope
  $scope.selectedTheme = config.theme;
  // watch this model and update the rootScope, so we can
  // can bind to it outside of this scope
  $scope.$watch('selectedTheme', function(theme) {
    $rootScope.selectedTheme = theme;
    // and update the 'config' service
    config.theme = theme;
  });
}];

/**
 * Controller for the list of Songs
 */
mod.SetListCtrl = [
'$scope', '$http', 'models', 'utils',
function( $scope, $http, models, utils ) {
  $scope.songs = [];
  $http.get('/test-data.json')
    .success(function(data, status, headers, config) {
      angular.forEach(data.songs, function(value) {
        $scope.songs.push(new models.Song(value));
      });
    });
}];

/**
 * Controller for a Song
 */
mod.SongCtrl = [
'$scope',
function( $scope ) {}
];

/**
 * Controller for a Device
 */
mod.DeviceCtrl = [
'$scope', 'utils',
function( $scope, utils ) {
  $scope.getClasses = function(device) {
    return utils.slugify(device.name)
        + (device.settings.length <= 4 ? ' narrow' : '');
  };
}];

/**
 * Controller for a Dial
 */
mod.DialCtrl = [
'$scope',
function( $scope ) {}
];

angular.module('setList.controllers', []).controller(mod)