import { Link } from "@inertiajs/react";
import { ChevronRight } from "lucide-react";

export default function HeroSection() {
  return (
    <section className="bg-gray-50 dark:bg-gray-900">
      <div className="container mx-auto flex flex-col items-center px-4 py-16 md:flex-row md:py-24">
        <div className="mb-10 md:mb-0 md:w-1/2">
          <h2 className="mb-4 text-4xl font-bold tracking-tight text-gray-900 dark:text-white md:text-5xl">
            Discover Our Latest Collection
          </h2>
          <p className="mb-6 max-w-lg text-lg text-gray-600 dark:text-gray-300">
            Shop the newest trends and find your perfect style with our curated selection of premium products.
          </p>
          <div className="flex space-x-4">
            <Link className="inline-flex items-center rounded-md bg-black px-6 py-3 text-base font-medium text-white hover:bg-gray-800 dark:bg-white dark:text-black dark:hover:bg-gray-200" href="#">
              Shop Now
              <ChevronRight className="ml-2 h-5 w-5" />
            </Link>
            <Link className="inline-flex items-center rounded-md border border-gray-300 bg-white px-6 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700" href="#">
              Learn More
            </Link>
          </div>
        </div>
        <div className="md:w-1/2">
          <div className="overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800 aspect-[4/3]">
            <div className="h-full w-full bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900/20 dark:to-purple-900/20"></div>
          </div>
        </div>
      </div>
    </section>
  );
}
