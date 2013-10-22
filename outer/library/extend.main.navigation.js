define({

	make : function (module, modules) { 

		var self         = this
		this.main        = module.main
		this.setup       = module.pass
		this.animation   = modules.animation
		this.maker       = Object.create(modules.node_making_tools)
		this.class_names = {
			main                             : "bar_outer_wrap",
			wrap                             : "bar",
			move_arrow                       : "with-icon-progress-pop-up-arrow",
			navigation                       : "navigation_wrap",
			inner_navigation                 : "navigation_inner_wrap",
			regular_navigation               : "navigation",
			regular_navigation_item          : "navigation_text_for_bar",
			regular_navigation_item_selected : "with-icon-for-navigation-text-for-bar-active",
		}

		this.body        = this.maker.create_parts({
			wrap : {
				attribute : {
					"class" : this.class_names.main
				},
				children : {
					wrap : {
						attribute : {
							"class" : this.class_names.wrap
						},
						children : {
							arrow : {
								type : "span",
								attribute : {
									"class" : this.class_names.move_arrow
								},
							},
							navigation : {
								attribute : {
									"class" : this.class_names.navigation
								},
								children : {
									wrap : {
										attribute : {
											"class" : this.class_names.inner_navigation
										},
										children : {	
											navigation : {
												attribute : {
													"class" : this.class_names.regular_navigation
												},
												children : function (parent) { 

													for (var index = 0; index < self.setup.paths.length; index++)
														parent["path_"+index] = {
															node : this.create_and_return_node({
																type : "a",
																property : {
																	textContent : self.setup.paths[index].name
																},
																attribute : { 
																	"class" : self.class_names[(index === 0 ? "regular_navigation_item_selected" : "regular_navigation_item" )],
																	"href"  : self.setup.paths[index].path,
																},
															})
														}

													return parent
												},
											},
										}
									}
								}
							},
							// progress_popup : {
									// 	attribute : {
									// 		"class" : this.class_names
									// 	},
									// 	children : {
									// 		title : {
									// 			attribute : {
									// 				"class" : this.class_names
									// 			},
									// 			children : {
									// 				text : {
									// 					type : "span",
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 				},
									// 				icon : {
									// 					type : "span",
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 					children : {
									// 						icon : {
									// 							type : "span",
									// 							attribute : {
									// 								"class" : this.class_names
									// 							},
									// 						}
									// 					}
									// 				}
									// 			}
									// 		},
									// 		text : {
									// 			type : "p",
									// 			attribute : { 
									// 				"class" : this.class_names
									// 			}
									// 		}
									// 	}
							// },						
							// welcome_popup : {
									// 	attribute : {
									// 		"class" : this.class_names
									// 	},
									// 	children : {
									// 		placeholder : {
									// 			attribute : {
									// 				"class" : this.class_names
									// 			},
									// 			children : {
									// 				text : {
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 				},
									// 				sign_out : {
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 				}
									// 			}
									// 		},
									// 		sign_in : {
									// 			attribute : {
									// 				"class" : this.class_names
									// 			},
									// 			children : {
									// 				title    : {
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 				},
									// 				email    : {
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 				},
									// 				password : {
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 				},
									// 				enter : {
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 				},
									// 				forgoten : {
									// 					type : "span",
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 				}
									// 			}
									// 		},
									// 		register : {
									// 			attribute : {
									// 				"class" : this.class_names
									// 			},
									// 			children : {
									// 				text   : {
									// 					attribute : {
									// 						"class" : this.class_names
									// 					},
									// 				},
									// 				button : {
									// 					type : "a",
									// 					attribute : {
									// 						"class" : this.class_names,
									// 						"href"  : ""
									// 					}
									// 				}
									// 			}
									// 		}
									// 	}
							// },							
							// user_button : {
									// 	attribute : {
									// 		"class" : this.class_names
									// 	},
									// 	children : {
									// 		button_one : {
									// 			type : "span",
									// 			attribute : {
									// 				"class" : this.class_names
									// 			},
									// 		},
									// 		button_two : {
									// 			type : "span",
									// 			attribute : {
									// 				"class" : this.class_names
									// 			},
									// 		}
									// 	}
							// },
						}
					}
				}
			}
		})
		
		this.maker.append_parts({
			parts : this.body
		})

		return this
	},
});	