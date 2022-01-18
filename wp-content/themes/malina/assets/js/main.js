/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../styles/main.scss';

// Import components scripts
// import Navbar from './components/navbar'
// import Input from './components/input'
// import LanguageSelection from './components/languageSelection';

// // Import js for pages
// import HomePage from './pages/home-page/home-page';
import MusicBand from './pages/music-band-registration/music-band-registration';
// import ContactPage from './pages/contact-page/contact-page';
// import DashboardPage from './pages/dashboard/dashboard';

// Include router
import Router from './vendors/router';

// Create new route
const router = new Router();

const themeRoutes = {
    // Common scripts for all pages
    common: {
        init: () => {
            // Initialize page loading
            Navbar.init();
            // Input.init();
            // LanguageSelection.init();
        },
        finalize: () => {
            // Loading.hide();
        },
    },

    // Scripts to be initialized on the front page
    homePage: {
        init: () => {
            // HomePage.init();
        },
    },
    // homePage: HomePage,

    // Scripts to be initialized on the contact page
    contactPage: {
        init: () => {
            // ContactPage.init();
        },
    },

    // Scripts to be initialized on the dashboard page
    dashboardPage: {
        init: () => {
            // DashboardPage.init();
        },
    },

    // singleRecipe: SingleRecipe
};

// Init router
router.setRoutes(themeRoutes);

// Apply router
jQuery(document).ready(()=>{
    // Load all router events
    // router.loadEvents();
    console.log("MAIN LOADED");
});