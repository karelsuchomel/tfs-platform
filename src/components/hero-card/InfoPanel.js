import React from 'react';

import ContactIconSvg from './contact-icon.svg';
import SigilBrnoPng from './znak-brno.png';
import SigilBrnoStredPng from './znak-brno-stred.png';

export default class InfoPanel extends React.Component {
	render() {
		return(
			<div className="hero-card-info-wrap">
				<label htmlFor="mobile-tooltip-toggle" id="mobile-tooltip-label"></label>
				<div className="erb-container">
					<img src={ ContactIconSvg } alt="znak města Brna" />
					<div className="tooltip">
						<strong>+420&nbsp;543&nbsp;211&nbsp;912</strong>
						<br />
						<a href="mailto:vedeni@zshroznova.cz">vedeni@zshroznova.cz</a>
					</div>
				</div>
				<div className="erb-container">
					<img src={ SigilBrnoStredPng } alt="znak městské části Brno střed" />
					<div className="tooltip">
						Zřizovatel:&nbsp;Městská&nbsp;část
						<br/>
						Brno-střed
					</div>
				</div>
				<div className="erb-container">
					<img src={ SigilBrnoPng } alt="znak města Brna" />
					<div className="tooltip">
						Pilotní&nbsp;škola&nbsp;projektu&nbsp;
						<br/>
						MMB Angličtina&nbsp;od&nbsp;1.&nbsp;třídy
					</div>
				</div>
				<label id="close-expanded-info-rollet-toggle" htmlFor="mobile-tooltip-toggle"></label>
			</div>
		);
	}
}
