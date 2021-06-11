<?php

if (!function_exists('checkItemsInCart')) 
{
    function checkItemsInCart ($items) 
    {
        foreach ($items as $item)
        {
            $item->push('inCart');
            $item->inCart = 0;

            if (session()->has('items') && in_array($item->id, session()->get('items'))) 
            {
                $item->inCart = 1;
            }
        }      
    }
}

if (!function_exists('sortItems')) 
{
    function sortItems ($items, $sortPhrase) 
    {
        switch ($sortPhrase) {
            case 'atoz':
                $items = $items->orderBy('nosaukums');
                break;
            case 'ztoa':
                $items = $items->orderByDesc('nosaukums');
                break;
            case 'ltoh':
                $items = $items->orderBy('cena');
                break;
            case 'htol':
                $items = $items->orderByDesc('cena');
                break;      
        } 
    }
}