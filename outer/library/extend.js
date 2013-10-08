define({

	definition : {
		requires : [],
	},

	make : function (module) {

		var extension;
		
		module.instructions.pass = module.instructions.pass || false;

		if ( !module.instructions.into )                                          throw new Error("the \"into\" paramater for the extend component has not been specified");
		if ( !module.instructions.into.replace(/^\s+|\s+$/, "") )                 throw new Error("the \"into\" paramater for the extend component is empty");
		if ( !this.components[module.instructions.into] )                         throw new Error("the \""+ module.instructions.into +"\" extension does not exist, try checking if you have spelt it right or included it in the manifest.define");
		if ( this.components[module.instructions.into].constructor === Function ) throw new Error(" the \""+ module.instructions.into +"\" extension is a function, all manifest modules must be an object of methods with a make method which will act as a constructor");
		if ( this.components[module.instructions.into].constructor === Object && !this.components[module.instructions.into].make ) throw new Error(" the \""+ module.instructions.into +"\" extension must have an make method which will construct it");

		extension = Object.create(this.components[module.instructions.into]).make(module.instructions.pass, module.library);
		module.parent.appendChild(extension);
	},

	components : {}
});