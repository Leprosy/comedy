"use client";

import { ChangeEventHandler, Ref, useState } from "react";

// TODO: templating?
type Validator = (value: string, params?: unknown) => string | null;
type Filter = (value: string) => string;

type InputProps = {
  name?: string;
  ref?: Ref<HTMLInputElement>;
  label?: string;
  value?: string;
  placeholder?: string;
  validators?: Validator | Array<Validator>;
  filters?: Filter | Array<Filter>;
  onChange?: ChangeEventHandler<HTMLInputElement>;
};

const doValidation = (value: string, validators: Validator | Array<Validator>): string[] => {
  if (!Array.isArray(validators)) validators = [validators];
  const errors: string[] = [];

  validators.forEach((validator) => {
    const result = validator(value);

    if (result) {
      errors.push(result);
    }
  });

  return errors;
};

const doFilter = (value: string, filters: Filter | Array<Filter>): string => {
  if (!Array.isArray(filters)) filters = [filters];

  filters.forEach((filter) => {
    value = filter(value);
  });

  return value;
};

export const InputValidators = {
  notEmpty: (msg) => {
    return (value) => (value.trim() === "" ? msg : null);
  },
  isNumber: (msg) => {
    return (value) => (isNaN(Number(value)) || value.trim() === "" ? msg : null);
  },
  length: (msg, params) => {
    return (value) => (value.length >= (params.min || 0) && value.length <= (params.max || Infinity) ? null : msg);
  },
} satisfies Record<string, (msg: string, params?: unknown) => Validator>;

export const InputFilters = {
  trim: (value) => value.trim(),
  toUpper: (value) => value.toUpperCase(),
} satisfies Record<string, Filter>;

export function Input({ name, label, value, validators, filters, placeholder, onChange, ref }: InputProps) {
  const [errors, setErrors] = useState<string[]>([]);

  return (
    <label className="block mb-5 bg-gray-900 p-5">
      {label}
      <input
        name={name}
        ref={ref}
        className="w-full p-2 mt-2 text-black"
        placeholder={placeholder}
        value={value}
        onChange={(event) => {
          if (filters) event.target.value = doFilter(event.target.value, filters);

          if (validators) {
            const errors = doValidation(event.target.value, validators);
            setErrors(errors);
          }

          if (onChange) {
            onChange(event);
          }
        }}
      />
      <ul className="error text-red">
        {errors.map((msg: string, i: number) => (
          <li key={i}>{msg}</li>
        ))}
      </ul>
    </label>
  );
}
