import React from 'react';

interface FeaturedCategoryProps {
  title: string;
  description?: string;
  image?: string;
  link?: string;
}

export default function FeaturedCategory({ 
  title, 
  description = 'Explore our featured collection', 
  image = '', 
  link = '#' 
}: FeaturedCategoryProps) {
  return (
    <div className="group relative overflow-hidden rounded-xl  max-h-64
    bg-white shadow-lg transition-transform hover:scale-[1.01]
     dark:bg-gray-800">
      <div className="aspect-[16/9] w-full overflow-hidden">
        {image ? (
          <img 
            src={image} 
            alt={title} 
            className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" 
          />
        ) : (
          <div className="h-full w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 dark:from-indigo-700 dark:via-purple-700 dark:to-pink-700"></div>
        )}
      </div>
      <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-70"></div>
      <div className="absolute bottom-0 left-0 p-6 text-white">
        <h3 className="mb-2 text-2xl font-bold">{title}</h3>
        <p className="mb-4 max-w-md text-sm text-gray-200">{description}</p>
        <a 
          href={link} 
          className="inline-flex items-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
        >
          Shop Now
          <svg className="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14 5l7 7m0 0l-7 7m7-7H3" />
          </svg>
        </a>
      </div>
    </div>
  );
}
