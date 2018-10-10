import React from 'react';
import ReactDOM from 'react-dom';

import NavigationTopBar from './components/navigation-top-bar/NavigationTopBar.js';
import NavigationSideBar from './components/navigation-side-bar/NavigationSideBar.js';
import HeroCard from './components/hero-card/HeroCard.js';
import Home from './components/home/Home.js';
import './index.sass';

class App extends React.Component {
	render() {
		return(
			<div className="app-wrapper">

				<input name="toggle-menu" id="toggle-menu-checkbox" type="checkbox" />
				<NavigationTopBar />

				<div id="content-wrap" className="clear-both">

					<div id="side-panel-bg-fix"></div>
					<NavigationSideBar />
					<div id="side-list-fixed-background-mobile"></div>
					<div id="dimmer-content"></div>

					<HeroCard />

					<Home />
				</div>

			</div>
		);
	}
}

ReactDOM.render(
	<App />,
	window.document.getElementById('root')
);

/*
bahavior of the side menu
*/

// handle current item (open sub-menu)
function handleSideMenuCurrentItem()
{
	var selectedItem = document.querySelector('ul#menu-bocni-seznam > li > ul > li.current-menu-item');
	if (selectedItem)
	{
		var currentMenu = selectedItem.parentNode;
		selectedItem.parentNode.style.transition = '0s';
		selectedItem.parentNode.className = "sub-menu open";
		var numOfItems = currentMenu.children.length;
		var sum = 0;
		for(var i = 0; i < numOfItems; ++i){
			sum += currentMenu.children[i].offsetHeight;
		}
		currentMenu.style.transition = '0s';
		currentMenu.style.height = sum + 'px';

		setTimeout(function(){ 
			currentMenu.style.transition = '0.5s';
			selectedItem.parentNode.style.transition = '0.5s';
		}, 100);
	}
}
handleSideMenuCurrentItem();

function handleSideMenu(e)
{
	// select containing <ul></ul>
	var currentMenu = e.currentTarget.parentNode.children[1];

	if(currentMenu.className.includes("open"))
	{
		currentMenu.className = "sub-menu";
		currentMenu.style.height = '0px';
	} else {
		// close other unrolled menu
		var otherMenuIsUnrolled = document.querySelector("ul > li > ul.open");
		if (otherMenuIsUnrolled)
		{
			var otherUnrolledMenu = document.querySelector("ul > li > ul.open");
			otherUnrolledMenu.className = "sub-menu";
			otherUnrolledMenu.style.height = '0px';
		}

		// open menu
		currentMenu.className = "sub-menu open";

		var numOfItems = currentMenu.children.length;
		var sum = 0;
		for(var i = 0; i < numOfItems; ++i){
			sum += currentMenu.children[i].offsetHeight;
		}
		currentMenu.style.height = sum + 'px';
	}
}

function closeMobileMenu()
{
	document.getElementById('toggle-menu-checkbox').checked = false;
}

// event currentMenuener for sliding currentMenus
var handleSideMenuElements = document.querySelectorAll("#menu-side-bar-list-container ul.menu > li > a")
for (var i = handleSideMenuElements.length - 1; i >= 0; i--) {
	handleSideMenuElements[i].addEventListener("click", handleSideMenu); 
}

// event currentMenuener for mobile background
document.getElementById('dimmer-content').addEventListener('click', closeMobileMenu);