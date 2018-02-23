<?php
/*************************************************************************
php easy :: pagination scripts set - Version Two
==========================================================================
Author:      php easy code, www.phpeasycode.com
Web Site:    http://www.phpeasycode.com
Contact:     webmaster@phpeasycode.com
*************************************************************************/
function paginate_two($reload, $page, $tpages, $adjacents) {
	
	$firstlabel = "&laquo;&nbsp;";
	$prevlabel  = "&lsaquo;&nbsp;";
	$nextlabel  = "&nbsp;&rsaquo;";
	$lastlabel  = "&nbsp;&raquo;";
	
	$out = "<ul class=\"pagination pagination-sm\">\n";
	
	// first
	if($page>($adjacents+1)) {
		$out.= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $reload . "\">" . $firstlabel . "</a></li>\n";
	}
	else {
		$out.= "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">" . $firstlabel . "</a></li>\n";
	}
	
	// previous
	if($page==1) {
		$out.= "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">" . $prevlabel . "</a></li>\n";
	}
	elseif($page==2) {
		$out.= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $reload . "\">" . $prevlabel . "</a></li>\n";
	}
	else {
		$out.= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $reload . "&amp;page=" . ($page-1) . "\">" . $prevlabel . "</a></li>\n";
	}
	
	// 1 2 3 4 etc
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">" . $i . "</a></li>\n";
		}
		elseif($i==1) {
			$out.= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $reload . "\">" . $i . "</a></li>\n";
		}
		else {
			$out.= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $reload . "&amp;page=" . $i . "\">" . $i . "</a></li>\n";
		}
	}
	
	// next
	if($page<$tpages) {
		$out.= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $reload . "&amp;page=" .($page+1) . "\">" . $nextlabel . "</a></li>\n";
	}
	else {
		$out.= "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">" . $nextlabel . "</a></li>\n";
	}
	
	// last
	if($page<($tpages-$adjacents)) {
		$out.= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $reload . "&amp;page=" . $tpages . "\">" . $lastlabel . "</a></li>\n";
	}
	else {
		$out.= "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">" . $lastlabel . "</a></li>\n";
	}
	
	$out.= "</ul>";
	
	return $out;
}
?>