

 <form class="navbar-form nopadding" role="search" methos="GET" action="continuesearch.php">
                <div id="suggest">
                    <input type="text" class="form-control b-search " onkeyup="suggest(this.value);" onblur="fill();" placeholder="Search" id="whattosearch" name="whattosearch">
                    <div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/arrow1.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div></div>
        </div>
                        <button style="font-family:Arial, Helvetica, sans-serif;" class="btn search-btn" type="submit">Search</button>
                  
               
            </form>