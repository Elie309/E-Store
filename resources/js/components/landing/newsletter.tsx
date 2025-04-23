import { Button } from "../ui/button";
import { Input } from "../ui/input";

export default function Newsletter() {
    return (
        <section className="bg-gray-100 py-16 dark:bg-gray-900">
            <div className="container mx-auto px-4">
                <div className="mx-auto max-w-2xl text-center">
                    <h2 className="mb-4 text-3xl font-bold text-gray-900 dark:text-white">Sign up for our newsletter</h2>
                    <p className="mb-8 text-gray-600 dark:text-gray-400">Get the latest updates and exclusive offers right to your inbox.</p>
                    <div className="flex flex-col sm:flex-row sm:justify-center space-x-2">
                    
                        <Input 
                            type="email"
                            placeholder="Enter your email address"
                            className="max-w-md"
                            required
                        ></Input>
                        <Button variant={"default"}>
                            Subscribe
                        </Button>
                    </div>
                </div>
            </div>
        </section>
    );
}
