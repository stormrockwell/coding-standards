export interface Greeting {
	recipient: string;
	excited?: boolean;
}

export function greet({ recipient, excited = false }: Greeting): string {
	const punctuation = excited ? '!' : '.';

	return `Hello, ${recipient}${punctuation}`;
}
