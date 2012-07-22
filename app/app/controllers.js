'use strict';

/* Controllers */

var mod = {}

mod.ThemeCtrl = [
'$scope', '$rootScope', 'config',
function( $scope, $rootScope, config ) {
  $scope.selectedTheme = config.theme;
  $scope.themes = [
    {id: 'helvetica', name: 'Helvetica'},
    {id: 'futura', name: 'Futura'},
    {id: 'orbitron', name: 'Orbitron'},
    {id: 'lithos-pro', name: 'Lithos Pro'},
    {id: 'hotel-solid', name: 'Hotel Solid'},
    {id: 'mostra-nuova-alt-c', name: 'Mostra Nuova Alt C'}
  ];
  $scope.$watch('selectedTheme', function(theme) {
    $rootScope.selectedTheme = theme;
    config.theme = theme;
  });
}];
// mod.ThemeCtrl.$inject = [];

mod.SetListCtrl = function( $scope ) {
  function Song(settings) {
    this.title = settings.title;
    this.tuning = settings.tuning;
    this.devices = settings.devices;
  };
  Song.prototype = {
    id: function() {
      return this.title.replace(/[^a-z0-9]+/g, '-').replace(/-{2,}/, '-');
    }
  }
  $scope.songs = [
    new Song({
      title: 'Spheres', tuning: 'D', devices: [
        { name: 'DD-20', settingsLabel: '550ms', settings: [12, 1.5, 10.5, 11] }
      ]
    })
  ];
};
mod.SongCtrl = function( $scope ) {};
mod.DeviceCtrl = function() {};
mod.DialCtrl = function() {};

angular.module('setList.controllers', []).controller(mod)