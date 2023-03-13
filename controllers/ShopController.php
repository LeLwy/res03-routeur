<?php  
 
class ShopController extends AbstractController {  
  
    private ProductManager $pm;  
    private CategoryManager $cm;  
  
    public function __construct()  
    {  
        $this->pm = new ProductManager();  
        $this->cm = new CategoryManager();  
    }

    /* Pour la route de la home */  
    public function categoriesList() : void  
    {  
        $categories = $this->cm->getAllCategories();  
    
        $this->render("index", [  
            "categories" => $categories  
        ]);  
    }

    /* Pour la route /categories/:slug-categorie */  
    public function productsInCategory(string $categorySlug) : void  
    {  
        $products = $this->cm->getCategoryBySlug($categorySlug);  
    
        $this->render("category", [  
            "products" => $products  
        ]);  
    }

    /* Pour la route /categories/produits */  
    public function productsList() : void  
    {  
        $products = $this->pm->getAllProducts(); 
    
        $this->render("products", [  
            "products" => $products  
        ]);  
    }

    /* Pour la route /produits/:slug-produit */  
    public function productDetails(string $productSlug) : void  
    {  
        $product = $this->pm->getProductBySlug($productSlug);
    
        $this->render("product", [  
            "product" => $product
        ]);  
    }
  
}