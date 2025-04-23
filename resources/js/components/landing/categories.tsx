import FeaturedCategory from './featured/featured-category';
import CategoryItem from './featured/category-item';

export default function Categories() {
  const categories = ['Clothing', 'Electronics', 'Home & Kitchen', 'Beauty'] as const;
  
  type CategoryKey = typeof categories[number];
  
  const categoryDescriptions: Record<CategoryKey, string> = {
    'Clothing': 'Discover the latest fashion trends and styles',
    'Electronics': 'Explore cutting-edge gadgets and devices',
    'Home & Kitchen': 'Transform your living space with our collection',
    'Beauty': 'Premium beauty products for your self-care routine'
  };


  return (
    <section className="bg-gray-50 py-16 dark:bg-gray-900">
      <div className="container mx-auto px-4">
        <h2 className="mb-8 text-3xl font-bold text-gray-900 dark:text-white">Shop by Category</h2>
        
        {/* Featured Category */}
        <div className="mb-10">
          <FeaturedCategory 
            title="Summer Collection" 
            description="Discover our new summer essentials with up to 40% off. Limited time offer!"
          />
        </div>
    
        
        <div className="grid grid-cols-2 gap-4 md:grid-cols-4">
          {categories.map((category) => (
            <CategoryItem
              key={category}
              title={category}
              description={categoryDescriptions[category]}
            />
          ))}
        </div>
      </div>
    </section>
  );
}
