    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
      <div id="pad-wrapper">

        <div class="page-header">
          <h1>Les enfants <small>en résumé</small></h1>
      </div>


    <div class="row filter-block" id="tablewrapper">
        <div class="pull-left" id="tableheader">
            <div class="ui-select">
                <select onchange="sorter.search('query')">
                    <option>Filter users</option>
                    <option>Signed last 30 days</option>
                    <option>Active users</option>
                </select>
            </div>
            <input type="text" id="query" class="search order-search" placeholder="Tapez votre recherche ici..." onkeyup="sorter.search('query')">
        </div>
        <div class="pull-right">
            <p>Résultats <span id="startrecord">1</span>-<span id="endrecord">10</span> sur <span id="totalrecords">49</span></p>
            <a href="javascript:sorter.reset()" class="btn-flat new-product">Remettre à zéro</a>
        </div>
        <span class="details">
        </span>
    </div>





    <div class="row">
      <table id="table" class="table table-hover tinytable">
        <thead>
          <tr>
            <th class="asc">Prénom <i class="pull-right icon-sort"></i></th>
            <th class="head">Nom <i class="pull-right icon-sort"></i></th>
            <th class="head">Date de naissance <i class="pull-right icon-sort"></i></th>
            <th class="unsort">actions</th>
        </tr>
    </thead>
    <tbody>
      <tr class="evenrow" onmouseover="sorter.hover(0,1)" onmouseout="sorter.hover(0,0)">
         <td class="evenselected">Christophe</td>
         <td>Béghin</td>
         <td>02/01/1990</td>
         <td>actions...</td>
     </tr>
     <tr class="evenrow" onmouseover="sorter.hover(0,1)" onmouseout="sorter.hover(0,0)">
         <td class="evenselected">Clément</td>
         <td>Roy</td>
         <td>02/05/1990</td>
         <td>actions...</td>
     </tr>
     <tr class="evenrow" onmouseover="sorter.hover(0,1)" onmouseout="sorter.hover(0,0)">
         <td class="evenselected">Nedjma</td>
         <td>Behlouli</td>
         <td>01/12/1989</td>
         <td>actions...</td>
     </tr>
     <tr class="evenrow" onmouseover="sorter.hover(0,1)" onmouseout="sorter.hover(0,0)">
         <td class="evenselected">Coraline</td>
         <td>Assimon</td>
         <td>23/04/1989</td>
         <td>actions...</td>
     </tr>
 </tbody>
</table>
</div>


<div id="tablefooter">
  <div id="tablenav" style="display: block;">
     <div>
        <i class="icon-step-backward" onclick="sorter.move(-1,true)"></i>
        <i class="icon-chevron-left" onclick="sorter.move(-1)"></i>
        <i class="icon-chevron-right" onclick="sorter.move(1)"></i>
        <i class="icon-step-forward" onclick="sorter.move(1,true)"></i>
    </div>
    <div>
     <select id="pagedropdown" onchange="sorter.goto(this.value)"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
 </div>
 <div class="btn-reset"><a class="button blue" href="javascript:sorter.showall()">view all</a>
 </div>
</div>
<div id="tablelocation">
    <div>
        <select onchange="sorter.size(this.value)">
            <option value="5">5</option>
            <option value="10" selected="selected">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="txt-page">Entries Per Page</span>
    </div>


    <div class="page txt-txt">Page <span id="currentpage">1</span> of <span id="totalpages">5</span></div>
</div>
</div>
</div>
</div>

</div><!-- /.container -->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>