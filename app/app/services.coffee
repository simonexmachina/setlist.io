# Services

angular.module('setList.services', [])
	.value('version', '0.1')
	# create a 'config' service for sharing configuration between all scopes
	.service('config', () ->
		@theme = 'helvetica'
	)
	.service('utils', () ->
		@slugify = (str) ->
			str.toLowerCase().replace(/[^a-z0-9]/g, '-').replace(/--+/g, '-')
	)