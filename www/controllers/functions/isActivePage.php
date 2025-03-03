<?php
function isActivePage($currentPage, $pageToCheck) {
    return $currentPage === $pageToCheck ? 'active' : '';
}