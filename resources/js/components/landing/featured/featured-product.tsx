import { Heart, ShoppingCart, Star } from "lucide-react";
import { Button } from "../../ui/button";

interface ProductProps {
  product: {
    id: number;
    name: string;
    price: string;
    rating: number;
    reviewCount: number;
  };
}

export default function FeaturedProduct({ product }: ProductProps) {
  return (
    <div className="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
      <div className="relative aspect-square overflow-hidden bg-gray-100 dark:bg-gray-800">
        <div className="h-full w-full bg-gradient-to-br from-gray-200 to-gray-100 dark:from-gray-700 dark:to-gray-800"></div>
        <div className="absolute bottom-0 left-0 right-0 flex justify-end p-2">
          <button className="rounded-full bg-white p-2 text-gray-700 shadow-sm hover:text-gray-900 dark:bg-gray-800 dark:text-gray-300 dark:hover:text-white">
            <Heart className="h-4 w-4" />
          </button>
        </div>
      </div>
      <div className="p-4">
        <h3 className="text-lg font-medium text-gray-900 dark:text-white">{product.name}</h3>
        <div className="mb-2 flex items-center">
          <div className="flex text-yellow-400">
            {[1, 2, 3, 4, 5].map((star) => (
              <Star key={star} className={`h-4 w-4 ${star <= Math.floor(product.rating) ? 'fill-current' : ''}`} />
            ))}
          </div>
          <span className="ml-2 text-sm text-gray-500 dark:text-gray-400">{product.rating} ({product.reviewCount} reviews)</span>
        </div>
        <div className="flex items-center justify-between">
          <span className="text-lg font-bold text-gray-900 dark:text-white">{product.price}</span>
          <Button variant={"default"} >
            Add to Cart
            <ShoppingCart className="h-4 w-4" />
          </Button>
        </div>
      </div>
    </div>
  );
}
