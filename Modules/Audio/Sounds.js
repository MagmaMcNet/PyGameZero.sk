var $builtinmodule = function (name) {
	//
	const parm = new URLSearchParams(window.location.search);
	mod = {}
	function sound_files() {
		return $.ajax({
			dataType: 'script',
			url: "./Modules/Audio/GetAudio.php?ID="+parm.get("ID"),
			async: false
		}).responseText;
	}
	return sound_files();
}