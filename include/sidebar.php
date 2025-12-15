<nav class="side-menu">
	    <ul class="side-menu-list">
	        
	        <?php
				if($_SESSION['level']=='loket'){
			?>
	       <li class="red">
	            <a href="index">
	                <i class="fa fa-group"></i>
	                <span class="lbl">Antrian <?= $_SESSION['nama_layanan'];?></span>
	            </a>
	        </li>
			<li class="purple">
	            <a href="riwayat?mulai=&selesai=&j=">
	                <i class="fa fa-history"></i>
	                <span class="lbl">Riwayat Antrian <?= $_SESSION['nama_layanan'];?></span>
	            </a>
	        </li>
			<?php ;} if($_SESSION['level']=='admin'){?>
			<li class="red">
	            <a href="laporan?mulai=&selesai=&j=&l=">
	                <span class="fa fa-file-o"></span>
	                <span class="lbl">Laporan</span>
	            </a>
	        </li>
			<li class="blue">
	            <a href="feed">
	                <span class="fa fa-list"></span>
	                <span class="lbl">Running Text</span>
	            </a>
	        </li>
			<li class="green">
	            <a href="setting">
	                <span class="fa fa-gear"></span>
	                <span class="lbl">Setting</span>
	            </a>
	        </li>
			
			<?php ;} ?>
			</ul>
	
	    
	</nav><!--.side-menu-->