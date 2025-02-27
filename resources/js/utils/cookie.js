export const CookieManager = {
    isAccepted() {
        return localStorage.getItem("cookiesAccepted") === "true";
    },

    // Fonction pour initialiser les services de tracking uniquement si accepté
    initializeTracking() {
        if (this.isAccepted()) {
            // Initialiser Google Analytics, etc.
            this.initializeGoogleAnalytics();
            // Autres services...
        }
    },

    initializeGoogleAnalytics() {
        // Votre code Google Analytics ici
    },
};
