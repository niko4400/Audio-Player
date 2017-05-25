

<?php

/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2017-03-19
 * Time: 17:35
 */



if(session_check()==True) {
	include_once 'model/Playlist.php';
	include_once 'model/Track.php';
	include_once 'model/Music.php';
	
$playlists = Playlist::getPlaylists($dbConnection);
$playlistTmp = Playlist::getPlaylists($dbConnection);

$playlistsRes=NULL;
if($playlists!=false) {
	$playlistsRes= $playlists->fetch_array(MYSQLI_ASSOC);
}




//TODO PRZY PRZEKAZYWANIU JSON NIE MOZE BYC SPACJI W WARTOSCIACH DO KLUCZY
//TODO zamiana spacji na _ przy zapisywaniu plików

$muzyka_json=array();

if(isset($_GET['id'])) {
	$playlist= Playlist::getPlaylist($dbConnection, $_GET['id']);
	$playlist= $playlist->fetch_array(MYSQLI_ASSOC);

	$music = Track::getTracksPlaylistPlayer($dbConnection,$_SESSION['id'],$playlist['id']);
	$musicTmp = Track::getTracksPlaylistPlayer($dbConnection,$_SESSION['id'],$playlist['id']);
    $i=1;
    $music_json=array();
    while($musicRes = $musicTmp->fetch_array(MYSQLI_ASSOC)) {
        $muzyka_json["id"] ="".$i;
        $muzyka_json["track"] =str_replace(" ","_",$musicRes['mname']);
        $muzyka_json["wykonawca"] =str_replace(" ","_",$musicRes['mauthor']);

        $url = str_replace('/','|',$musicRes['murl']);
        $muzyka_json["url"] =$url;
        array_push($music_json,$muzyka_json);
        $i++;
    }

}else
    $playlist=NULL;

$music_json=json_encode($music_json);

//przy przekazywaniu json nie moze byc spacji w wartosciach do kluczy


    echo '
<div style="min-height: 700px;margin-top: 5%" >
    <div class="row">
        <div class="col-xs-4 col-sm-3 pos aside ">
            <div class="panel panel-default " >
                <div class="panel-heading">Playlisty</div>
                <div class="panel-body text-center" style="min-height: 80vh">';
   					 if(empty($playlistsRes['name'])) {
                        echo '
                           <div class="text-center" style="margin-top: 50%">
                              nie masz jeszcze stworzonej żadnej playlisty
                              <a href="?p=dodajplaylista#sticker">kliknij tutaj i dodaj teraz</a>
                           </div>';
                    }else {
                            do {
                            	echo '<a href = "?p=homepage&id='.$playlistsRes['id'].'#sticker" 
                                        class="btn btn-default  btn-block">
                                        '.$playlistsRes['name'].'
                                            <span style="position:inherit" 
												  class="badge">
												  '.$playlistsRes['count'].
											'</span>                                    
                                        </a>';
                            } while ($playlistsRes= $playlists->fetch_array(MYSQLI_ASSOC));
                    }

    echo'
                </div>
            </div>
         </div>
        <div class="col-xs-8 col-sm-9 pos main">
            <div class="panel panel-default " >
                <div class="panel-heading">               
                    <div id="panel-title" >';
   						 if($playlists==True)
                            echo'<br>';
                        else
                            echo $playlist['name'];
                      echo '
                    </div>
                        <select class="form-control" id="panel-select-title" style="background-color: inherit;color: inherit">';
                      while($playlistTmpRes = $playlistTmp->fetch_array(MYSQLI_ASSOC))
                           echo'
                            <option>'.$playlistTmpRes['name'].'</option>';

                         echo' 
                        </select>
                </div>
                <div class="panel-body" style="min-height: 80vh">
                     ';
                    if($playlist!=NULL){
                        echo'
                    <div class="row" >
                        <div class="col-xs-12 col-sm-5 pos">                          
                            <div class="img-thumbnail center-block" >
                                <img class="img-thumbnail center-block" 
                                        src="data:image/jpeg;base64,'.base64_encode($playlist['image'] ).'"
                                         style="max-height: 250px"/>
                                <div id="currentTrack" 
                                class="text-info center-block text-center" 
                                style="margin-bottom: 1%">
                                </div>                       
                                <audio id="odtwarzacz" controls
                                        onpause=check_play() 
                                        onplay=check_play();
                                        onended=next_track('.$music_json. ')
                                        style="width:100%">
                                        <source  src="http://www.w3schools.com/html/horse.ogg" type="audio/ogg">
                                        Your browser does not support the audio element.
                                </audio>
                            </div>
                            <div class="center-block">
                                 <button class="btn btn-default  col-xs-4 col-sm-4"
                                 onclick=prev_track(' .$music_json.')><<
                                 </button>
                                 <button id="btn-stop" class="btn btn-default col-xs-4 hidden col-sm-4"
                                 onclick=pause_track()>||
                                 </button>
                                 <button id="btn-start" class="btn btn-default col-xs-4  col-sm-4"
                                 onclick=start_track()>>
                                 </button>
                                <button class="btn btn-default col-xs-4 col-sm-4  "
                                 onclick=next_track('.$music_json.')>>>
                                 </button>
                            </div>
                        </div>
                        <div class="col-xs-0 col-sm-7 pos text-center">                           
                            <div style="margin-bottom: 20%;margin-top: 10%">
                                <h2 id="title-search-side">'.$playlist['name'].'</h2></div>
                            <div>
                                <form class="navbar-form " role="search">
                                    <div class="form-group">
                                        <input class="form-control" id="search"
                                            placeholder="Search" type="text" onkeyup=find('.$music_json.')>
                                        <select class="form-control" id="select">
                                            <option>utwór</option>
                                            <option>wykonawca</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table id="table" class="table table-striped table-hover" style="margin-top: 5%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>utwór</th>
                            <th>wykonawca</th>
                            <th>dodane</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>';
                        $i=1;
                        while($musicRes = $music->fetch_array(MYSQLI_ASSOC)) {
                        	$name =str_replace(' ','_',$musicRes['mname']);
                            echo'
                        <tr>
                            <td>'.$i.'</td>
                            <td><button class="btn btn-success"
                                    onclick=play('.json_encode($musicRes['murl']).',"'.$name.'") 
                                    style="border-radius: 13px;">
                                play
                                </button>
                            </td>
                            <td>'.$musicRes['mname'].'</td>
                            <td>'.$musicRes['mauthor'].'</td>                            
                            <td>content</td>
			    <td style="display:none;">'.$name.'</td>   
  			    <td style="display:none;">'.json_encode($musicRes['murl']).'</td>
                            <td><input type="hidden" id="nazwa" value="'.$name.'"><td>
                        </tr >
                        ';
                            $i++;
                       }
                        echo'
                        </tbody>
                    </table>
                    ';};
                    echo '
                </div>
            </div>
        </div>
    </div>
    <div class="clear-both"></div>
';
}else {
    include 'views/main.php';
}

?>