<h5 class="card-title"><?=$arr_contacto->nombre?></h5>
<ul class="fa-ul">
    <li class="text-muted"><span class="fa-li"><i class="far fa-building"></i></span><?=$arr_contacto->direccion?></li>
    <li class="text-muted"><span class="fa-li"><i class="fas fa-phone"></i></span><?=$arr_contacto->ntelefono?></li>
    <li class="text-muted"><span class="fa-li"><i class="fas fa-envelope"></i></span><a href="mailto: <?=$arr_contacto->email?>" target="_blank"> <?=$arr_contacto->email?></a>
    </li>
</ul>
