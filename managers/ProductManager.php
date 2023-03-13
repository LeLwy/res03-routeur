<?php

class ProductManager extends AbstractManager {

    public function getAllProducts() : array  
    { 
        $query = $this->db->prepare('SELECT * FROM products');
        $query->execute();
        $list = $query->fetchAll(PDO::FETCH_ASSOC);  
    
        return $list;  
    }  
    
    public function getProductBySlug(string $productSlug) : Product  
    {  
        $query = $this->db->prepare('SELECT * FROM products WHERE slug = :product_slug');

        $parameters = [
            'product_slug' => $productSlug
        ];

        $query->execute($parameters);

        $productParams = $query->fetch(PDO::FETCH_ASSOC);

        $product = new Product($productParams['name'], $productParams['slug'], $productParams['description'], $productParams['price']);  
    
        return $product;  
    }  
    
    public function getProductsByCategorySlug(string $categorySlug) : array  
    {  
        $query = $this->db->prepare('SELECT * FROM categories WHERE slug = :category_slug');

        $parameters = [
            'category_slug' => $categorySlug
        ];

        $query->execute($parameters);

        $list = $query->fetchAll(PDO::FETCH_ASSOC);  
    
        return $list;  
    }
}