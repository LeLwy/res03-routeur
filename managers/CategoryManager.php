<?php  
 
class CategoryManager extends AbstractManager {  
      
    public function getAllCategories() : array  
    {  

        $query = $this->db->prepare('SELECT * FROM categories');

        $query->execute();

        $list = $query->fetchAll(PDO::FETCH_ASSOC);  
    
        return $list;  
    }  
    
    public function getCategoryBySlug(string $categorySlug) : Category  
    {  

        $query = $this->db->prepare('SELECT * FROM categories WHERE slug = :category_slug');

        $parameters = [
            'category_slug' => $categorySlug
        ];

        $query->execute($parameters);

        $categoryParam = $query->fetch(PDO::FETCH_ASSOC);

        $category = new Category($categoryParam['name'], $categoryParam['slug'], $categoryParam['description']);  
    
        return $category;  
    }
}