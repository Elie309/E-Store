import React from 'react';

interface CategoryItemProps {
  title: string;
  description?: string;
  image?: string;
  link?: string;
}

export default function CategoryItem({
  title,
  description,
  image,
  link = '#'
}: CategoryItemProps) {
  return (
    <div className="group cursor-pointer overflow-hidden rounded-lg bg-white shadow-sm transition-all hover:shadow-md dark:bg-gray-800">
      <a href={link} className="block">
        <div className="aspect-square w-full bg-gray-100 dark:bg-gray-700">
          {image ? (
            <img 
              src={image} 
              alt={title} 
              className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" 
            />
          ) : (
            <div className="h-full w-full bg-gradient-to-br from-gray-200 to-gray-100 dark:from-gray-700 dark:to-gray-800"></div>
          )}
        </div>
        <div className="p-4">
          <h3 className="text-lg font-medium text-gray-900 dark:text-white">{title}</h3>
          {description && (
            <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">{description}</p>
          )}
        </div>
      </a>
    </div>
  );
}
