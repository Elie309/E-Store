import { SharedData } from "@/types";
import { Link, usePage } from "@inertiajs/react";
import { Heart, Menu, ShoppingCart, X, User, LogOut, Settings } from "lucide-react";
import { useState, useRef, useEffect } from "react";

export default function Header() {
    const [isDrawerOpen, setIsDrawerOpen] = useState(false);
    const [isUserMenuOpen, setIsUserMenuOpen] = useState(false);
    const userMenuRef = useRef<HTMLDivElement>(null);
    
    // Use Laravel auth from usePage
    const { auth } = usePage<SharedData>().props;
    const [isLoggedIn] = useState(auth.user !== null);

    const menuItems = [
        { label: "Home", href: "/" },
        { label: "Shop", href: "#" },
        { label: "Categories", href: "#" },
        { label: "About", href: "#" },
    ];

    const toggleDrawer = () => {
        setIsDrawerOpen(!isDrawerOpen);
    };

    const toggleUserMenu = () => {
        setIsUserMenuOpen(!isUserMenuOpen);
    };


    // Handle clicks outside of the user menu
    useEffect(() => {
        function handleClickOutside(event: MouseEvent) {
            if (userMenuRef.current && !userMenuRef.current.contains(event.target as Node)) {
                setIsUserMenuOpen(false);
            }
        }

        if (isUserMenuOpen) {
            document.addEventListener("mousedown", handleClickOutside);
        }
        
        return () => {
            document.removeEventListener("mousedown", handleClickOutside);
        };
    }, [isUserMenuOpen]);

    return (
        <header className="border-b border-gray-200 dark:border-gray-800">
            <div className="container mx-auto flex h-16 items-center justify-between px-4">
                <div className="flex items-center">
                    {/* Mobile menu button */}
                    <button
                        className="mr-2 rounded-full p-2 text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 md:hidden"
                        onClick={toggleDrawer}
                    >
                        <Menu className="h-5 w-5" />
                    </button>
                    <h1 className="text-2xl font-bold text-gray-900 dark:text-white">E-Store</h1>
                    <nav className="ml-10 hidden space-x-8 md:flex">
                        {menuItems.map((item, index) => (
                            <Link
                                key={index}
                                className="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                                href={item.href}
                            >
                                {item.label}
                            </Link>
                        ))}
                    </nav>
                </div>
                <div className="flex items-center space-x-4">
                    <button className="rounded-full p-2 text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                        <Heart className="h-5 w-5" />
                    </button>
                    <button className="rounded-full p-2 text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                        <ShoppingCart className="h-5 w-5" />
                    </button>
                    
                    {isLoggedIn ? (
                        <div className="relative" ref={userMenuRef}>
                            <button 
                                onClick={toggleUserMenu}
                                className="flex items-center rounded-full bg-gray-100 p-2 text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                            >
                                <User className="h-5 w-5" />
                            </button>
                            
                            {isUserMenuOpen && (
                                <div className="absolute right-0 mt-2 w-48 rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 dark:bg-gray-900 dark:ring-gray-700">
                                    <Link 
                                        href={route('profile.edit')}
                                        className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                                    >
                                        <div className="flex items-center">
                                            <User className="mr-2 h-4 w-4" />
                                            Profile
                                        </div>
                                    </Link>
                                    <Link 
                                        href={route('profile.edit')} 
                                        className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                                    >
                                        <div className="flex items-center">
                                            <Settings className="mr-2 h-4 w-4" />
                                            Settings
                                        </div>
                                    </Link>
                                    <Link 
                                        href={route('logout')}
                                        method="post"
                                        as="button"
                                        className="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                                    >
                                        <div className="flex items-center">
                                            <LogOut className="mr-2 h-4 w-4" />
                                            Logout
                                        </div>
                                    </Link>
                                </div>
                            )}
                        </div>
                    ) : (
                        <Link className="rounded-md bg-black px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 dark:bg-white dark:text-black dark:hover:bg-gray-200" href={route('login')}>
                            Sign in
                        </Link>
                    )}
                </div>
            </div>

            {/* Overlay for the drawer */}
            {isDrawerOpen && (
                <div 
                    className="fixed inset-0 bg-black/20 bg-opacity-50 z-40" 
                    onClick={toggleDrawer}
                ></div>
            )}

            {/* Mobile Drawer */}
            <div className={`fixed inset-0 z-50 transform ${isDrawerOpen ? 'translate-x-0' : '-translate-x-full'} transition-transform duration-300 ease-in-out md:hidden`}>
                <div className="absolute left-0 top-0 h-full max-w-xl w-2/3 bg-white p-4 shadow-lg dark:bg-gray-900">
                    <div className="flex justify-between items-center mb-6">
                        <h2 className="text-xl font-bold text-gray-900 dark:text-white">Menu</h2>
                        <button
                            className="rounded-full p-2 text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                            onClick={toggleDrawer}
                        >
                            <X className="h-5 w-5" />
                        </button>
                    </div>
                    <nav className="flex flex-col space-y-4">
                        {menuItems.map((item, index) => (
                            <Link
                                key={index}
                                className="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                                href={item.href}
                                onClick={toggleDrawer}
                            >
                                {item.label}
                            </Link>
                        ))}
                        
                        {isLoggedIn ? (
                            <>
                                <Link
                                    className="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                                    href={route('profile.edit')}
                                    onClick={toggleDrawer}
                                >
                                    <User className="mr-2 h-4 w-4" />
                                    Profile
                                </Link>
                                <Link
                                    className="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                                    href={route('profile.edit')}
                                    onClick={toggleDrawer}
                                >
                                    <Settings className="mr-2 h-4 w-4" />
                                    Settings
                                </Link>
                                <Link
                                    className="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                                    href={route('logout')}
                                    method="post"
                                    as="button"
                                    onClick={toggleDrawer}
                                >
                                    <LogOut className="mr-2 h-4 w-4" />
                                    Logout
                                </Link>
                            </>
                        ) : (
                            <Link
                                className="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                                href={route('login')}
                                onClick={toggleDrawer}
                            >
                                Sign in
                            </Link>
                        )}
                    </nav>
                </div>
            </div>
        </header>
    );
}
