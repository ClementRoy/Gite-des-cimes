    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper" class="users-list">
            <div class="row header">
                <h3>Ajouter un enfant</h3>
            </div>

            <div class="row form-wrapper">
                <!-- left column -->
                <div class="col-md-8 column">
                    <form>
                        <div class="field-box">
                            <label>Normal input:</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Inline input:</label>
                            <div class="col-md-7">
                                <input class="form-control inline-input" placeholder=".inline-input" type="text">
                            </div>
                        </div>                            
                        <div class="field-box">
                            <label>Inline Password:</label>
                            <div class="col-md-7">
                                <input class="form-control inline-input" type="password" value="blablabla">
                            </div>
                        </div>
                        <div class="field-box">
                            <label>Read only:</label>
                            <div class="col-md-7">
                                <input class="form-control inline-input" type="text" readonly="readonly" value="read only input">
                            </div>
                        </div>
                        <div class="field-box">
                            <label>With tooltip:</label>
                            <div class="col-md-7">
                                <input class="form-control inline-input" data-toggle="tooltip" data-trigger="focus" title="" data-placement="top" type="text" data-original-title="Please insert a valid email address">
                            </div>
                        </div>
                        <div class="field-box">
                            <label>Predefined value:</label>
                            <div class="col-md-7">
                                <div class="predefined">
                                    <span class="value">http://</span>
                                    <input class="form-control inline-input" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="field-box">
                            <label>With max length:</label>
                            <div class="col-md-7">
                                <input class="form-control inline-input" type="text" placeholder="max 20 characters here" maxlength="20">
                            </div>
                        </div>                            
                        <div class="field-box">
                            <label>Textarea:</label>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="4" style="margin: 0px -42.171875px 0px 0px; width: 451px; height: 94px;"></textarea>
                            </div>
                        </div>
                        <div class="field-box">
                            <label>Checkboxes:</label>
                            <label class="checkbox-inline">
                              <div class="checker" id="uniform-inlineCheckbox1"><span class="checked"><input type="checkbox" id="inlineCheckbox1" value="option1"></span></div> Option 1
                            </label>
                            <label class="checkbox-inline">
                              <div class="checker" id="uniform-inlineCheckbox2"><span><input type="checkbox" id="inlineCheckbox2" value="option1"></span></div> Option 2
                            </label>
                            <label class="checkbox-inline">
                              <div class="checker" id="uniform-inlineCheckbox3"><span><input type="checkbox" id="inlineCheckbox3" value="option1"></span></div> Option 3
                            </label>
                        </div>
                        <div class="field-box">
                            <label>Radiobuttons:</label>
                            <div class="col-md-8">
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios1"><span class=""><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked=""></span></div>
                                    Option one is this and that—be sure to include why it's great
                                </label>
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios2"><span class="checked"><input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"></span></div>
                                    Option two can be something else and selecting it will deselect option one
                                </label>
                            </div>                                
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/scripts.php'); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>