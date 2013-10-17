define({	

	make : function () {

		this.then_queue = []
		return this
	},

	send : function (send) {
		
		var request, data, self;

		self                       = this
		request 				   = new XMLHttpRequest()
		request.responseType       = ""
		data                       = this.convert_object_into_url_paramaters({ 
			object : send.data 
		})
		request.onreadystatechange = function (change) {
			
			if ( request.readyState !== 4 ) return

			var index, then_return;

			index       = 0
			then_return = false

			for (index = 0; index < self.then_queue.length; index++)
				then_return = self.then_queue[index].call(self, {
					change     : change, 
					previous   : then_return,
					paramaters : send,
				})
		}

		if ( send.type === "GET" && send.data ) 
			send.url = send.url +"?"+ data

		request.open(send.type, send.url, true)

		if ( send.type === "POST" ) 
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")

		request.send(( send.type === "POST" && send.data ? data : null ))

		if ( send.after_send ) 
			send.after_send.call(this, send)

		return this
	},

	then : function (method) {
		this.then_queue.push(method)
		return this
	},

	convert_object_into_url_paramaters : function (convert) {

		var paramaters = []

		for ( var property in convert.object )
			paramaters.push(property +"="+ (
				convert.object[property].constructor === String || 
				convert.object[property].constructor === Number ?
					convert.object[property] :
					window.encodeURIComponent(JSON.stringify(convert.object[property]))
				)
			)

		return paramaters.join("&")
	}
});