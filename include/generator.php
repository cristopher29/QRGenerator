<div class="container">
    <div class="row mt-3">
        <div class="col-md-8 pt-3 mb-3">
            <div id="alert_placeholder">
                <?php
                if (strlen($_ERROR) > 0) {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button><?php echo $_ERROR; ?>
                    </div>
                    <?php
                } ?>
            </div>
            <div class="row bg-white">
                <form role="form" id="create" class="needs-validation" novalidate>
                    <input type="submit" class="d-none">

                    <?php
                    /**
                     * QR CODE DATA
                     */ ?>
                    <div class="col-sm-12 pb-2 bg-light">
                        <div class="form-group">
                            <h4>Enlace</h4>
                            <div class="form-group">
                                <label for="malink">Enlace</label>
                                <input type="url" name="link" id="malink" class="form-control"
                                       placeholder="http://" required="required"/>
                            </div>
                        </div> <!-- form group -->
                    </div><!-- col sm12-->

                    <div class="col-sm-12 pb-2 bg-light">
                        <div class="form-group">
                            <h4>
                                Opciones
                            </h4>
                            <?php
                            /**
                             * MAIN QR CODE CONFIG
                             */
                            ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Tamaño</label>
                                        <select name="size" class="custom-select qrcode-size-selector">
                                            <?php
                                            for ($i = 8; $i <= 32; $i += 4) {
                                                $value = $i * 25;
                                                echo '<option value="' . $i . '" ' . ($matrixPointSize == $i ? 'selected' : '') . '>' . $value . '</option>';
                                            }; ?>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label>Calidad</label>
                                        <select name="level" class="custom-select">
                                            <option value="L" <?php if ($errorCorrectionLevel == "L") echo "selected"; ?>>
                                                Baja L
                                            </option>
                                            <option value="M" <?php if ($errorCorrectionLevel == "M") echo "selected"; ?>>
                                                Media M
                                            </option>
                                            <option value="Q" <?php if ($errorCorrectionLevel == "Q") echo "selected"; ?>>
                                                Alta Q
                                            </option>
                                            <option value="H" <?php if ($errorCorrectionLevel == "H") echo "selected"; ?>>
                                                Máxima H
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label>Fondo</label>
                                        <div class="collapse" id="collapse-background">
                                            <div class="input-group qrcolorpicker colorpickerback">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </div>
                                                <input type="text" class="form-control" data-format="hex"
                                                       value="<?php echo $stringbackcolor; ?>" name="backcolor">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-control custom-switch mt-2">
                                    <input type="checkbox" class="custom-control-input" id="trans-bg"
                                           name="transparent">
                                    <label class="custom-control-label"
                                           for="trans-bg">Fondo transparente</label>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label>Color</label>
                                        <div class="input-group qrcolorpicker mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-format="hex"
                                                   value="<?php echo $stringfrontcolor; ?>" name="frontcolor">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="gradient-bg"
                                                       name="gradient">
                                                <label class="custom-control-label"
                                                       for="gradient-bg">Degradado</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="collapse" id="collapse-gradient">
                                            <label>Segundo color</label>
                                            <div class="input-group qrcolorpicker mb-2" id="collapse-gradient">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </div>
                                                <input type="text" class="form-control qrcolorpicker_bg"
                                                       data-format="hex"
                                                       value="#8900D5" name="gradient_color">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="radial-gradient" name="radial">
                                                    <label class="custom-control-label"
                                                           for="radial-gradient">Radial</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label>Borde de marcador</label>
                                        <div class="input-group qrcolorpicker">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-format="hex"
                                                   value="<?php echo $stringfrontcolor; ?>" name="marker_out_color">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label>Centro de marcador</label>
                                        <div class="input-group qrcolorpicker">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-format="hex"
                                                   value="<?php echo $stringfrontcolor; ?>" name="marker_in_color">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="markers-bg"
                                               name="markers_color">
                                        <label class="custom-control-label"
                                               for="markers-bg">Color de marcador personalizado</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php
                                    require dirname(dirname(__FILE__)) . '/lib/markers.php';

                                    $patterns = $markersIn;
                                    unset($patterns['flurry']);
                                    unset($patterns['sun']);

                                    $styleselecta = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';

                                    foreach ($patterns as $pattern => $style) {
                                        $activeattr = ($pattern == 'default') ? 'checked' : '';
                                        $styleselecta .= '<label class="btn btn-light p-1">
                                            <input type="radio" name="pattern" value="' . $pattern . '" ' . $activeattr . '>
                                            <svg width="10" height="10" viewBox="0 0 7 7" xmlns="http://www.w3.org/2000/svg">' . $style['path'] . '</svg>
                                        </label>';
                                    }
                                    $styleselecta .= '</div>';

                                    $markerselecta = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';

                                    foreach ($markers as $marker => $values) {
                                        $activeattr = ($marker == 'default') ? 'checked' : '';
                                        $markerselecta .= '<label class="btn btn-light p-1">
                                            <input type="radio" name="marker" value="' . $marker . '" ' . $activeattr . '>
                                            <svg width="32" height="32" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' . $values['path'] . '</svg>
                                        </label>';
                                    }

                                    $markerselecta .= '</div>';

                                    $markerselectaIn = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';

                                    foreach ($markersIn as $marker => $values) {
                                        $activeattr = ($marker == 'default') ? 'checked' : '';
                                        $markerselectaIn .= '<label class="btn btn-light p-1">
                                            <input type="radio" name="marker_in" value="' . $marker . '" ' . $activeattr . '>
                                            <svg width="20" height="20" viewBox="0 0 6 6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' . $values['path'] . '</svg>
                                        </label>';
                                    }

                                    $markerselectaIn .= '</div>';

                                    ?>
                                    <div class="col-sm-12">
                                        <label>Puntos</label>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <?php echo $styleselecta; ?>
                                    </div>

                                    <div class="col-sm-12">
                                        <label>Borde de marcador</label>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <?php echo $markerselecta; ?>
                                    </div>

                                    <div class="col-sm-12">
                                        <label>Centro de marcador</label>
                                    </div>
                                    <div class="col-sm-12 mb-4">
                                        <?php echo $markerselectaIn; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>
                                            Logo
                                        </h4>
                                    </div>

                                    <?php
                                    if ($_CONFIG['uploader'] == true) { ?>
                                        <div class="col-12 py-2">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input"
                                                       aria-describedby="validate-upload" id="upmarker">
                                                <div id="validate-upload" class="invalid-feedback">
                                                    Imagen inválida
                                                </div>
                                                <label class="custom-file-label"
                                                       for="file">Sube tu logo o selecciona uno</label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    /**
                                     * Watermarks
                                     */

                                    //
                                    // Default watermarks
                                    //
                                    $waterdir = "images/watermarks/";
                                    $watermarks = glob($waterdir . '*.{gif,jpg,png}', GLOB_BRACE);
                                    $count = count($watermarks);
                                    if ($_CONFIG['uploader'] == true || $count > 0) { ?>
                                        <div class="col-12 pt-2">
                                            <div class="logoselecta form-group">
                                                <div class="btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-light p-1" data-toggle="tooltip"
                                                           data-placement="bottom">
                                                        <input type="radio" name="optionlogo" value="none" checked="">
                                                        <img class="img-fluid" src="images/x.png">
                                                    </label>
                                                    <?php
                                                    foreach ($watermarks as $key => $water) {
                                                        echo '<label class="btn btn-light p-1';
                                                        if ($optionlogo == $water) echo ' active ';
                                                        echo '" data-toggle="tooltip" data-placement="bottom">
                                                    <input type="radio" name="optionlogo" value="' . $water . '"';
                                                        if ($optionlogo == $water) echo ' checked';
                                                        echo ' id="optionlogo' . $key . '"><img src="' . $water . '"></label>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div><!-- collapse -->

                </form>
            </div> <!-- row -->
        </div><!-- col sm-8 -->

        <div class="col-md-4 sticky-top">
            <nav class="navbar sticky-top navbar-light bg-light">
                <?php
                //
                // FINAL QR CODE placeholder
                //
                ?>
                <div class="placeresult">
                    <div class="form-group text-center wrapresult">
                        <div class="resultholder">
                            <img class="img-fluid" id="qrcoded" src="<?php echo $_CONFIG['placeholder']; ?>"/>
                            <div class="infopanel"></div>
                        </div>
                    </div>
                    <div class="preloader"><i class="fa fa-cog fa-spin"></i></div>
                    <div class="form-group text-center linksholder"></div>
                    <button class="btn btn-lg btn-block btn-primary ellipsis" id="submitcreate">
                        <i class="fa fa-magic"></i> Generar código QR</button>
                </div>
            </nav>
        </div><!-- col md-4-->
    </div><!-- row -->
</div><!-- container -->
