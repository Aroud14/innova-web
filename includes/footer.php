<footer class="section page-footer">
    <div class="novi-background bg-cover bg-default">
        <div class="shell-wide">
            <div class="hr bg-gray-light"></div>
        </div>
        <div class="section-60">
            <div class="shell">
                <div class="range range-50 range-lg-justify range-xs-center">
                    <div class="cell-md-3 cell-lg-3">
                        <a class="reveal-inline-block" href="index.php" style="width: 100%; height: 120px; overflow: hidden;">
                            <?php
                                if($datosEmpresa["logo2"] != "")
                                {
                                    echo '<img src="admin/archivos/configuracion/imagenes/'.$datosEmpresa["logo2"].'" alt="" srcset="Logo footer" style="max-width: 100%; height: auto;">';
                                }
                                else
                                {
                                    echo '<img src="admin/archivos/configuracion/imagenes/'.$datosEmpresa["logo"].'" alt="" srcset="Logo footer" style="max-width: 100%; height: auto;">';
                                }
                            ?>
                        </a>
                        <div class="offset-top-30 text-center">
                            <?php
                                if($datosEmpresa["instagram"] != "" && $datosEmpresa["facebook"] != "" && $datosEmpresa["whatsapp"] != "" && $datosEmpresa["telefono"] != "" && $datosEmpresa["correo"] != "")
                                {
                                }
                            ?>

                            <ul class="list-inline list-inline-xs list-inline-madison">
                                <?= $datosEmpresa["instagram"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-instagram icon-circle icon-gray-light-filled" target="_blank" href="'.$datosEmpresa["instagram"].'"></a></li>' : ''  ?>

                                <?= $datosEmpresa["facebook"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-facebook icon-circle icon-gray-light-filled" target="_blank" href="'.$datosEmpresa["facebook"].'"></a></li>' : ''  ?>

                                <?= $datosEmpresa["whatsapp"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-whatsapp icon-circle icon-gray-light-filled" target="_blank" href="https://api.whatsapp.com/send?phone='.$datosEmpresa['whatsapp'].'&text=Hola,%20¿Me%20podria%20dar%20mas%20imformación?"></a></li>' : ''  ?>
                                
                                <?= $datosEmpresa["correo"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-send icon-circle icon-gray-light-filled" target="_blank" href="mailto:'.$datosEmpresa["correo"].'"></a></li>' : ''  ?>
                                
                                <?= $datosEmpresa["telefono"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-phone icon-circle icon-gray-light-filled" target="_blank" href="tel:'.$datosEmpresa["telefono"].'"></a></li>' : ''  ?>
                            </ul>
                        </div>
                    </div>
                    <div class="cell-xs-10 cell-md-5 cell-lg-4 text-lg-left">
                        <h6 class="text-bold">Contactanos</h6>
                        <div class="text-subline"></div>
                        <div class="offset-top-30">
                            <ul class="list-unstyled contact-info list">
                                <?php
                                    if($datosEmpresa["telefono"] != "")
                                    {
                                        ?>
                                            <li>
                                                <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                                                    <div class="unit-left"><span class="icon novi-icon mdi mdi-phone text-middle icon-xs text-madison"></span></div>
                                                    <div class="unit-body">
                                                        <a class="text-dark" href="tel:<?= $datosEmpresa["telefono"] ?>"><?= $datosEmpresa["telefono"] ?></a>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                    }

                                    if($datosEmpresa["whatsapp"] != "")
                                    {
                                        ?>
                                            <li>
                                                <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                                                    <div class="unit-left"><span class="icon novi-icon mdi mdi-whatsapp text-middle icon-xs text-madison"></span></div>
                                                    <div class="unit-body">
                                                        <a class="text-dark" href="https://api.whatsapp.com/send?phone=<?= $datosEmpresa['whatsapp'] ?>&text=Hola,%20¿Me%20podria%20dar%20mas%20imformación?">
                                                            <?= $datosEmpresa["whatsapp"] ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                    }

                                    if($datosEmpresa["direccion"] != "")
                                    {
                                        ?>
                                            <li>
                                                <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                                                    <div class="unit-left"><span class="icon novi-icon mdi mdi-map-marker text-middle icon-xs text-madison"></span></div>
                                                    <div class="unit-body text-left"><?= $datosEmpresa["direccion"] ?></div>
                                                </div>
                                            </li>
                                        <?php
                                    }

                                    if($datosEmpresa["correo"] != "")
                                    {
                                        ?>
                                            <li>
                                                <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                                                    <div class="unit-left"><span class="icon novi-icon mdi mdi-email-open text-middle icon-xs text-madison"></span></div>
                                                    <div class="unit-body"><a href="mailto:<?= $datosEmpresa["correo"] ?>"><?= $datosEmpresa["correo"] ?></a></div>
                                                </div>
                                            </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="cell-xs-10 cell-md-8 cell-lg-4 text-lg-left">
                        <h6 class="text-bold">Recibe Nuestras promociones</h6>
                        <div class="text-subline"></div>
                        <div class="offset-top-30 text-left">
                            <p>Enter your email address to get the latest University news, special events and student activities delivered right to your inbox.</p>
                        </div>
                        <div class="offset-top-10">
                            <form class="rd-mailform form-subscribe" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                                <div class="form-group">
                                    <div class="input-group input-group-sm"><label class="form-label" for="form-email">Your e-mail</label><input class="form-control" id="form-email" type="email" name="email" data-constraints="@Required @Email"><span class="input-group-btn"><button class="btn btn-sm btn-primary" type="submit">Suscribete</button></span></div>
                                </div>
                                <div class="form-output"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-5 bg-madison context-dark novi-background">
            <div class="shell text-md-left">
                <p class="">© <span class="copyright-year">2019</span> All Rights Reserved Terms of Use and <a href="privacy.html">Privacy Policy.</a><span> Design&nbsp;by Patshala</span></p>
            </div>
        </div>
    </div>
</footer>