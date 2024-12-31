export const includedOptionsByForfait = {
    premium: ["ecommerce", "logoPhotos", "socialMedia", "Dashboard"],
    standard: ["logoPhotos", "socialMedia"],
    starter: [],
};

export const templateOptions = [
    {
        id: "logoPhotos",
        name: "Création de logo + Photos Pro",
        description: "Design professionnel de votre identité visuelle",
        price: 99,
        icon: "bx-image",
    },
    {
        id: "socialMedia",
        name: "Réseaux Sociaux",
        description: "Création Conseil et gestion de vos réseaux sociaux",
        price: 179,
        icon: "bx-share-alt",
    },
    {
        id: "Dashboard",
        name: "Dashboard (CRM)",
        description: "Suivi détaillé de vos performances",
        price: 299,
        icon: "bx-line-chart",
    },
    {
        id: "ecommerce",
        name: "E-commerce",
        description: "Solution complète de vente en ligne",
        price: 299,
        icon: "bx-store",
    },
];

export const maintenancePlans = [
    {
        id: "basic",
        name: "Basic",
        price: 49,
        features: [
            "Mises à jour de sécurité",
            "Sauvegardes mensuelles",
            "Support email",
        ],
    },
    {
        id: "pro",
        name: "Pro",
        price: 99,
        features: [
            "Mises à jour de sécurité",
            "Sauvegardes hebdomadaires",
            "Support prioritaire 24/7",
            "Optimisation des performances",
        ],
    },
];
