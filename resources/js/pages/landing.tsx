import { Head, Link } from '@inertiajs/react';
import { ChevronRight, Heart, ShoppingCart, Star, Truck } from 'lucide-react';
import LandingLayout from "@/layouts/landing-layout";
import HeroSection from "@/components/landing/hero-section";
import FeaturedProducts from "@/components/landing/featured-products";
import Categories from "@/components/landing/categories";
import Features from "@/components/landing/features";
import Newsletter from "@/components/landing/newsletter";

export default function Landing() {
    return (
        <LandingLayout>
            <HeroSection />
            <FeaturedProducts />
            <Categories />
            <Features />
            <Newsletter />
        </LandingLayout>
    );
}
