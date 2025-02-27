export const includedOptionsByForfait = {
    starter: [],
    "starter+": ["logoPhotos"],
    standard: ["logoPhotos", "socialMedia"],
};

export const templateOptions = [
    {
        id: "logoPhotos",
        name: "Logo + Photos Pro",
        description: "Design de logo unique et séance photos professionnelle",
        price: 199,
        icon: "bx-image",
    },
    {
        id: "socialMedia",
        name: "Réseaux Sociaux",
        description: "Configuration et stratégie réseaux sociaux",
        price: 299,
        icon: "bx-share-alt",
    },
    {
        id: "crm",
        name: "CRM Intégré",
        description: "Gestion de la relation client et suivi commercial",
        price: 599,
        icon: "bx-data",
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
