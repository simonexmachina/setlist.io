# Directives

angular.module('setList.directives', [])
	.directive('version', (version) ->
      (scope, elm, attrs) ->
        elm.text(version)
    )