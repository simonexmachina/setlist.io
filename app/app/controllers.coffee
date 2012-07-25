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

mod.DialCtrl = [ "$scope", "$document", ($scope, $document) ->
  $scope.mouseMove = (event) ->
    if $scope.previousPosition > event.screenY
      if $scope.setting <= 12
        $scope.setting = $scope.setting + 0.5
    else
      if $scope.setting >= 0
        $scope.setting = $scope.setting - 0.5
    $scope.$apply()
    $scope.previousPosition = event.screenY

  $scope.mouseDown = ->
    document = $document[0]
    $document[0].onmousemove = $scope.mouseMove
    $document[0].onmouseup = $scope.mouseUp

  $scope.mouseUp = ->
    $document[0].onmousemove = null
    $document[0].onmouseup = null
]
angular.module("setList.controllers", []).controller mod
