
/*function clearPlayButton(length) {
    var table  = document.getElementById('table');
    var th = table.getElementsByTagName("th");
    var tr = table.getElementsByTagName("tbody");
    tr = tr.getElementsByTagName("tr");
    var i;
    for(i=0;i<=length;i++) {
        alert(tr[i].getElementsByTagName["td"][0].innerHTML);
    }
}*/

//start pierwszego utworu
$(document).ready(function() {
    var i=0;
	$('#table tr').each(function() {
		var name = $(this).find("td").eq(5).text();
		var url = $(this).find("td").eq(6).text();
		if(i==1) {
			url = url.replace(/"/g,'');
			url = url.replace('\\','');
			play(url,name,false);
		}
		i++;
	});

});


function check_play() {
    var audio = document.getElementById('odtwarzacz');
    if(audio.paused) {
        document.getElementById('btn-stop').className='hidden';
        document.getElementById('btn-start').className='btn btn-default col-xs-4 show';
    }else {
        document.getElementById('btn-start').className='hidden';
        document.getElementById('btn-stop').className='btn btn-default col-xs-4 show';
    }
}

function pause_track() {
    document.getElementById('odtwarzacz').autoplay = 0;
    document.getElementById('odtwarzacz').pause();
}

function start_track() {
    if(document.getElementById('odtwarzacz').src=="")
        return 0;
    document.getElementById('odtwarzacz').autoplay = 1;
    document.getElementById('odtwarzacz').play();
}


function check_next_track(muzyka,src,next) {
    var i;
    //clearPlayButton(muzyka.length);
    for(i=0;i<=muzyka.length;i++) {
        if(muzyka[i].url.replace('|','/') == "music/"+src) {
           // var r;
            if(next==1) {
                document.getElementById('currentTrack').innerHTML = muzyka[i + 1].track.replace(/_/g, ' ');
                return (muzyka[i + 1].url.replace('|', '/'));
            }
            else {
                document.getElementById('currentTrack').innerHTML = muzyka[i - 1].track.replace(/_/g, ' ');
                return (muzyka[i - 1].url.replace('|', '/'));
            }
        }

    }

}


function prev_track(muzyka){
    var src = document.getElementById('odtwarzacz').currentSrc;
    var splitSrc=src.split('/');

    var nextTrack=check_next_track(muzyka,splitSrc[splitSrc.length-1],0);

    document.getElementById('odtwarzacz').src=nextTrack;
    document.getElementById('odtwarzacz').load();

}

function next_track(muzyka) {
    var src = document.getElementById('odtwarzacz').currentSrc;
    var splitSrc=src.split('/');

    var nextTrack=check_next_track(muzyka,splitSrc[splitSrc.length-1],1);

    document.getElementById('odtwarzacz').src=nextTrack;
    document.getElementById('odtwarzacz').load();



}

function play(url,nazwa,autoplay) {
    nazwa = nazwa.replace(/_/g,' ');
    document.getElementById('odtwarzacz').autoplay = autoplay;
    document.getElementById('odtwarzacz').src=url;
	if(autoplay!=false)
		document.getElementById('odtwarzacz').play();

    document.getElementById('currentTrack').innerHTML=nazwa;


}


function show() {
    document.getElementById('btn').className='hidden';
    document.getElementById('change_pass').className='show';

}

function ajax_add(utwor,kategoria) {

    if(document.getElementById(utwor).innerHTML=="+") {
        $.ajax({
            type: 'post',
            url: 'database/ajax_script.php',
            data: {action: '+', id_utwor: utwor, id_kategoria: kategoria},
            success: function () {
                document.getElementById(utwor).className="btn btn-warning";
                document.getElementById(utwor).innerHTML = "-";
            }
        });
    }
    else{
        $.ajax({
            type: 'post',
            url: 'database/ajax_script.php',
            data: {action: '-', id_utwor: utwor, id_kategoria: kategoria},
            success: function () {
                document.getElementById(utwor).className="btn btn-success";
                document.getElementById(utwor).innerHTML = "+";
            }
        });

    }


}
//TODO do ogarnięcia
var loadFile = function(event) {
    var output = document.getElementById('photo');
    output.src = URL.createObjectURL(event.target.files[0]);
};


function find(muzyka) {
  /*  var music = [{ "id":"1", "track":"utwór1", "wykonawca":"wykonawca1" },
    { "id":"2", "track":"utwór2", "wykonawca":"wykonawca2" },
    { "id":"3", "track":"utwór3", "wykonawca":"wykonawca3" },
    { "id":"4", "track":"utwór4", "wykonawca":"wykonawca4" },
    { "id":"5", "track":"utwór5", "wykonawca":"wykonawca5" },
    { "id":"6", "track":"utwór6", "wykonawca":"wykonawca6" },
    { "id":"7", "track":"utwór7", "wykonawca":"wykonawca7" },
    { "id":"8", "track":"utwór8", "wykonawca":"wykonawca8" },
    { "id":"9", "track":"utwór9", "wykonawca":"wykonawca9" },
    { "id":"10", "track":"utwó101`", "wykonawca":"wykonawca10" }
    ];*/


    var table  = document.getElementById('table');
    var search = document.getElementById('search').value;
    var select = document.getElementById('select').value;
    var url;
    var cell;
    var cell2;
    var cell3;
    var cell4;
    var cell5;
    var insertRow;
    var i;
    var nazwa;

    var x=parseInt(document.getElementById("table").rows.length);
  //  table.insertRow(table.childElementCount);
    for(i=1;i<x;i++){
        table.deleteRow(1);
    }

    if(search=='') {
        for(i=0;i<10;i++) {
            x=parseInt(document.getElementById("table").rows.length);
                    insertRow = table.insertRow(x);
                    cell = insertRow.insertCell(0);
                    cell2 = insertRow.insertCell(1);
                    cell3 = insertRow.insertCell(2);
                    cell4 = insertRow.insertCell(3);
                    cell5 = insertRow.insertCell(4);
                    cell.innerHTML = muzyka[i].id;
                    url = muzyka[i].url.replace('|','/');
                    cell2.innerHTML = '<button class="btn btn-success" style="border-radius: 13px"' +
                        ' onclick=play("'+url+'","'+muzyka[i].track+'",1)>play</button>';
                    cell3.innerHTML = muzyka[i].track.replace(/_/g,' ');
                    cell4.innerHTML = muzyka[i].wykonawca.replace(/_/g,' ');
                    cell5.innerHTML = '';
        }
        return 0;
    }else {
        if(select==="utwór"){
            var utwor;
            for(i=0;i<=muzyka.length;i++) {
                utwor = muzyka[i].track.toUpperCase();
                if(utwor.search(search.toUpperCase()) != -1) {
                    x=parseInt(document.getElementById("table").rows.length);
                    insertRow = table.insertRow(x);
                    cell = insertRow.insertCell(0);
                    cell2 = insertRow.insertCell(1);
                    cell3 = insertRow.insertCell(2);
                    cell4 = insertRow.insertCell(3);
                    cell5 = insertRow.insertCell(4);
                    cell.innerHTML = muzyka[i].id;
                    url = muzyka[i].url.replace('|','/');
                    cell2.innerHTML = '<button class="btn btn-success" style="border-radius: 13px"' +
                        ' onclick=play("'+url+'","'+muzyka[i].track+'",1)>play</button>';
                    cell3.innerHTML = muzyka[i].track.replace(/_/g,' ');
                    cell4.innerHTML = muzyka[i].wykonawca.replace(/_/g,' ');
                    cell5.innerHTML = '';
                }
            }
            return  0;
        }else {
            var wykonawca;
            for(i=0;i<=muzyka.length;i++) {
                wykonawca = muzyka[i].wykonawca.toUpperCase();
                if(wykonawca.search(search.toUpperCase()) != -1) {
                   x=parseInt(document.getElementById("table").rows.length);
                    insertRow = table.insertRow(x);
                    cell = insertRow.insertCell(0);
                    cell2 = insertRow.insertCell(1);
                    cell3 = insertRow.insertCell(2);
                    cell4 = insertRow.insertCell(3);
                    cell5 = insertRow.insertCell(4);
                    cell.innerHTML = muzyka[i].id;
                    url = muzyka[i].url.replace('|','/');
                    cell2.innerHTML = '<button class="btn btn-success" style="border-radius: 13px"' +
                        ' onclick=play("'+url+'","'+muzyka[i].track+'",1)>play</button>';
                    cell3.innerHTML = muzyka[i].track.replace(/_/g,' ');
                    cell4.innerHTML = muzyka[i].wykonawca.replace(/_/g,' ');
                    cell5.innerHTML = '';
                }

                }
          return 0;
        }
    }


    }
