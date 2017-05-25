<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2017-04-02
 * Time: 12:46
 */

echo ' 
    <div class="container panel panel-default" style="margin-top:5%;max-width: 50%">
        <div class="panel-body">
            <form class="form-horizontal">
                <fieldset>
                    <legend>Profil</legend>  
                     <div class="text-center">
                            <label class="control-label" for="focusedInput"><h3>Imie</h3></label>
                            <input class="form-control center-block  text-center" 
                                    style="width: 50%; margin-top: 2%" 
                                    id="focusedInput" 
                                    name="imie" value="'.$_SESSION['imie'].'">
                            
                            <button type="button" id="btn" onclick="show()" 
                                    class="btn btn-default btn-lg btn-block center-block"
                                    style="width:50%;margin-top: 2%">
                                        Zmień hasło
                            </button>
                                                 
                            <div id="change_pass" class="hidden">
                                    
                            <label class="control-label " 
                                style="margin-top: 2%"
                                for="stare_haslo"><h4>Poprzednie hasło</h4>
                            </label>
                            <input class="form-control center-block text-center" 
                                style="width:50%;margin-top: 2%"
                                id="haslo" name="haslo" >   
                                   
                            <label class="control-label " 
                                style="margin-top: 2%"
                                for="nowe_haslo"><h4>Nowe hasło</h4>
                            </label>
                            <input class="form-control center-block  text-center" 
                                style="width:50%;margin-top: 2%"
                                id="nowe_haslo" name="nowe_haslo" >      
                               
                            </div>   
                            <button type="submit" 
                                class="btn btn-primary btn-lg btn-block center-block"
                                style="width:50%;margin-top:4%">
                            Enter
                            </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>';