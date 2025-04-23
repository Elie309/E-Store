import { Link } from "@inertiajs/react";
import { ChevronRight } from "lucide-react";
import FeaturedProduct from "./featured/featured-product";

interface Product {
  id: number;
  name: string;
  price: string;
  rating: number;
  reviewCount: number;
}

export default function FeaturedProducts() {
  const products: Product[] = [
    { id: 1, name: "Stylish T-Shirt", price: "$29.99", rating: 5, reviewCount: 24 },
    { id: 2, name: "Wireless Headphones", price: "$89.99", rating: 4.5, reviewCount: 18 },
    { id: 3, name: "Leather Backpack", price: "$59.99", rating: 4.8, reviewCount: 32 },
    { id: 4, name: "Smart Watch", price: "$129.99", rating: 4.7, reviewCount: 41 }
  ];

  return (
    <section className="py-16">
      <div className="container mx-auto px-4">
        <h2 className="mb-8 text-3xl font-bold text-gray-900 dark:text-white">Featured Products</h2>
        <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
          {products.map((product) => (
            <FeaturedProduct key={product.id} product={product} />
          ))}
        </div>
        <div className="mt-10 flex justify-center">
          <Link className="inline-flex items-center rounded-md border border-gray-300 bg-white px-6 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700" href="#">
            View All Products
            <ChevronRight className="ml-2 h-5 w-5" />
          </Link>
        </div>
      </div>
    </section>
  );
}
