"use strict"
mod = {}
mod.SettingsCtrl = [ "$scope", "$rootScope", "config", ($scope, $rootScope, config) ->
  $scope.themes = [
    id: "helvetica"
    name: "Helvetica"
  ,
    id: "futura"
    name: "Futura"
  ,
    id: "orbitron"
    name: "Orbitron"
  ,
    id: "lithos-pro"
    name: "Lithos Pro"
  ,
    id: "hotel-solid"
    name: "Hotel Solid"
  ,
    id: "mostra-nuova-alt-c"
    name: "Mostra Nuova Alt C"
  ]
  $scope.selectedTheme = config.theme
  $scope.$watch "selectedTheme", (theme) ->
    $rootScope.selectedTheme = theme
    config.theme = theme
]
mod.SetListCtrl = [ "$scope", "$http", "models", "utils", ($scope, $http, models, utils) ->
  $scope.songs = []
  $http.get("/test-data.json").success (data, status, headers, config) ->
    angular.forEach data.songs, (value) ->
      $scope.songs.push new models.Song(value)
]
mod.SongCtrl = [ "$scope", ($scope) ->
]
mod.DeviceCtrl = [ "$scope", "utils", ($scope, utils) ->
  $scope.getClasses = (device) ->
    utils.slugify(device.name) + (if device.settings.length <= 4 then " narrow" else "")
]
mod.DialCtrl = [ "$scope", ($scope) ->
  $scope.degrees = 0
  $scope.mouseMove = (event) ->
    console.log $scope.previousPosition
    if $scope.previousPosition > event.clientY
      $scope.degrees = $scope.degrees + 7
      console.log $scope.degrees
    else
      $scope.degrees = $scope.degrees - 7
      console.log $scope.degrees
    $scope.$apply()
    $scope.previousPosition = event.clientY

  $scope.mouseDown = ->
    $('body').attr('unselectable','on').css('MozUserSelect','none')
    $(document).mousemove $scope.mouseMove
    $(document).mouseup $scope.mouseUp

  $scope.mouseUp = ->
    $('body').attr('unselectable',null).css('MozUserSelect',null)
    $(document).unbind "mousemove", $scope.mouseMove  
    $(document).unbind "mouseup", $scope.mouseUp  
    #$(document).mouseup null 
]
angular.module("setList.controllers", []).controller mod
