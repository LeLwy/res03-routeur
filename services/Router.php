<?php  
 
class Router {  

    private ShopController $ctrl;  
  
    public function __construct()  
    {  
        $this->ctrl = new ShopController();  
    }

    private function splitRouteAndParameters(string $route) : array  
    {  
        $routeAndParams = [];  
        $routeAndParams["route"] = null;  
        $routeAndParams["categorySlug"] = null;  
        $routeAndParams["productSlug"] = null;  
    
        if(strlen($route) > 0) // si la chaine de la route n'est pas vide (donc si ça n'est pas la home)  
        {  
            $tab = explode("/", $route);  
            
            if($tab[0] === "categories") // écrire une condition pour le cas où la route commence par "categories"  
            {  
                // mettre les bonnes valeurs dans le tableau 
                $routeAndParams["route"] = "categories";  
                $routeAndParams["categorySlug"] = $tab[1];
            }  
            else if($tab[0] === "produits") // écrire une condition pour le cas où la route commence par "produits"  
            {  
                // mettre les bonnes valeurs dans le tableau  
                $routeAndParams["route"] = "produits"; 
            }  
            else if($tab[0] === "produits" && $tab[1] !== null) // écrire une condition pour le cas où la route commence par "produits"  
            {  
                // mettre les bonnes valeurs dans le tableau  
                $routeAndParams["route"] = "produits";  
                $routeAndParams["productSlug"] = $tab[1];  
            }  
        }  
        else  
        {  
            $routeAndParams["route"] = "";  
        }  
    
        return $routeAndParams;  
    }

    public function checkRoute(string $route) : void  
    {  
        $routeTab = $this->splitRouteAndParameters($route);
        
        var_dump($routeTab);
    
        if($routeTab['route'] === "") // condition(s) pour envoyer vers la home  
        {  
            // appeler la méthode du controlleur pour afficher la home
            $this->ctrl->categoriesList();
        }  
        else if($routeTab['route'] === "produits" && $routeTab['productSlug'] === null) // condition(s) pour envoyer vers la liste des produits  
        {  
            // appeler la méthode du controlleur pour afficher les produits
            $this->ctrl->productsList();
        }  
        else if($routeTab['route'] === "categories" && $routeTab['categorySlug'] !== null) // condition(s) pour envoyer vers la liste des produits d'une catégorie  
        {  
            // appeler la méthode du controlleur pour afficher les produits d'une catégorie
            $this->ctrl->productsInCategory($routeTab['categorySlug']);  
        }  
        else if($routeTab['route'] === "produits" && $routeTab['productSlug'] !== null) // condition(s) pour envoyer vers le détail d'un produit  
        {  
            // appeler la méthode du controlleur pour afficher le détail d'un produit
            $this->ctrl->productDetails($routeTab['productSlug']);
        }  
    }
}