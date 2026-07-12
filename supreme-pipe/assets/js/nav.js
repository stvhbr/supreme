( function () {
  'use strict';
  var toggle = document.getElementById( 'nav-toggle' );
  var nav    = document.getElementById( 'main-nav' );
  if ( ! toggle || ! nav ) return;

  toggle.addEventListener( 'click', function () {
    var open = nav.classList.toggle( 'open' );
    toggle.classList.toggle( 'open', open );
    toggle.setAttribute( 'aria-expanded', open );
  } );

  nav.querySelectorAll( 'a' ).forEach( function ( a ) {
    a.addEventListener( 'click', function () {
      nav.classList.remove( 'open' );
      toggle.classList.remove( 'open' );
      toggle.setAttribute( 'aria-expanded', 'false' );
    } );
  } );
} )();
