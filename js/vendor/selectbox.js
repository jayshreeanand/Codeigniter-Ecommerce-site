

			$("#default-usage-select").selectbox().bind('change', function(){
				$('<div>Value of #default-usage-select changed to: '+$(this).val()+'</div>').appendTo('#demo-default-usage .demoTarget').fadeOut(5000, function(){
					$(this).remove();
				});
			});
