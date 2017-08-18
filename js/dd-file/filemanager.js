
var FileManager = $.Class.create({

	init: function(parent, name)
	{
		this.el = $("#filesList");
		this.files = {};
		this.url = "gallerys.edit.php";
		var uploader = new DragUpload("dropZone", {
										url: this.url,
										mousein_class: "dragover",
										onDropFile: this.showFileInList.bind(this),
										onProgress: this.onProgress.bind(this),
										onComplete: this.onLoad.bind(this)
									});

		this.initFiles();
	},
	createFile: function(name)
	{
		var file = new FileLine(this.el, name);
		file.onDelete = this.deleteFile.bind(this);
		this.files[name] = file;
		return file;
	},
	initFiles: function()
	{
		this.el.find(".b-file").each(function(i, el){
			var fileName = $(el).find("a").html();
			var file = this.createFile(fileName);
			file.el = $(el);
			file.bind();


		}.bind(this))
	},
	deleteFile: function(file)
	{
		var name = file.name;
		delete this.files[name];
		file.remove();
		this.sendDelete(name);
	},
	sendDelete: function(name)
	{
		$.ajax({
			  type: 'POST',
			  url: this.url+"?delete="+name,
			  complete: function(r, textStatus, errorThrown){

			  }
			});
	},
	showFileInList: function(e, fileName){
		var file = this.createFile(fileName);
		file.render();

	},
	onProgress: function(e, fileName){
		this.files[fileName].showProgress(e.loaded, e.total);

	},
	onLoad: function(e, fileName){
		var data = $.parseJSON(e.target.responseText);
		if (data) {
			if (data.fileType == 'image') {
				var content = '<div class="imageArea" id="'+data.intImageID+'" style="background: url('+data.imageUrl+') no-repeat; width:'+data.width+'px; height:'+data.height+'px;"><a href="'+data.imageOrigUrl+'" class="lightbox" rel="gallery" title="'+data.varRealFileName+'"  onclick="return false;"><div style="height:'+(data.height-20)+'px;clear:both; color: white; padding-left: 1px; text-shadow:1px 1px 0 black;">'+data.varRealFileName+'</div><img /></a><div style="height:1px;width:'+(data.width-20)+'px;float:left;"></div><div style="float:left;"><a href="javascript:deleteImage('+data.intImageID+',\''+data.varRealFileName+'\');" title="Удалить изображенние '+data.varRealFileName+'"><img src="/img/delete-icon.png" alt="Удалить" /></a></div></div>';
				$('#imagesListsortable').append(content);
			}			
		}
		this.files[fileName].finishLoading(data.Filename);
		
	}

});
