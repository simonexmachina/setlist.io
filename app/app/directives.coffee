# Directives

angular.module('setList.directives', [])
	.directive('version', (version) ->
      (scope, elm, attrs) ->
        elm.text(version)
    )

angular.module("setList.directives", [])
  .directive "draggable",  ($document) ->
    (scope, element, attrs) ->
      mouseUp = ->
        $document.unbind "mousemove"

      mouseMove = (event)->
        if scope.previousPosition > event.screenY
          if scope[attrs.draggable] < 12
            scope[attrs.draggable] = scope[attrs.draggable] + 0.5
        else
          if scope[attrs.draggable] > 0
            scope[attrs.draggable] = scope[attrs.draggable] - 0.5
        scope.previousPosition = event.screenY
        scope.$apply()

      element.bind "mousedown", ->
        $document.bind "mouseup",  mouseUp
        $document.bind "mousemove", mouseMove

