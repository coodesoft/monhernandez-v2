import {
    $whatWeDoSect
} from "./sections/whatWeDoSection.js";
import {
    $clientsSect
} from "./sections/clientsSection.js";
import {
    $impactSec
} from "./sections/impactSection.js";
import {
    $experienceSec
} from "./sections/experienceSection.js";
import {
    $methodSec
} from "./sections/methodSection.js";
import {
    $manifestoSect
} from "./sections/manifestoSection.js";
import {
    $servicesSect
} from "./sections/servicesSection.js";
import {
    $pensumSect
} from "./sections/pensumSection.js";
import {
    $
} from "./constants.js";

$(window).on('load', function () {

    /*
     *HOME
     */

    /*
     *Seccion What We Do
     */

    if ($('#what-we-do-section').length) {
        $whatWeDoSect();
    };

    /*
     * Seccion Clients
     */

    if ($('#clients-section').length) {
        $clientsSect();
    }

    /*
     * Seccion Impact
     */

    if ($('#impact-section').length) {
        $impactSec();
    }

    /*
     * Seccion Experience
     */

    if ($('#experience-section').length) {
        $experienceSec();
    }

    /*
     *ABOUT
     */

    /*
     * Seccion Method
     */

    if ($('#method-section').length) {
        $methodSec();
    }

    /*
     *Seccion Manifesto
     */
    if ($('#manifesto-section').length) {
        $manifestoSect();
    }

    /*
     *ABOUT
     */

    /*
     *Seccion Services
     */
    if ($('#services-section').length) {
        $servicesSect();
    }

    /*
     *AGENCY
     */

    /*
     *Seccion Pensum
     */
    if ($('#pensum-section').length) {
        $pensumSect();
    }

    new fullpage('[data-elementor-type="wp-page"] > .elementor-inner > .elementor-section-wrap', {
    	//options here
    	autoScrolling:true,
    	scrollHorizontally: true
    });

    $('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
		$(this).toggleClass('open');
	});
});
