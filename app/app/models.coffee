###

A service that provides injectable models.
Each model class is attached to the service instance and can be instantiated like so:

	MyCtrl = [
		'models',
		function( models ) {
    	new models.Song(value)
    }
  ]

###
angular.module('setList.models', [])
	.service('models', () ->
		@Song = class Song
			constructor: (settings) ->
				@title = settings.title;
				@tuning = settings.tuning;
				@devices = [];
				angular.forEach(settings.devices, (value) =>
					@devices.push(new Device(value));
				)
			id: ->
				return @title.replace(/[^a-z0-9]+/g, '-').replace(/-{2,}/, '-');

		@Device = class Device
			constructor: (settings) ->
				@name = settings.name
				@text = settings.text
				@settings = settings.settings || []
	)