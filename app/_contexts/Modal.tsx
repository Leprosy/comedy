"use client";

import { createContext, PropsWithChildren, useState } from "react";

type ModalContextState = {
  visible: boolean;
  setVisible: (arg: boolean) => void;
};

export const ModalContext = createContext<ModalContextState>({
  visible: false,
  setVisible: () => {},
});

export default function ModalProvider({ children }: PropsWithChildren) {
  const [visible, setVisible] = useState(false);

  return (
    <ModalContext.Provider value={{ visible, setVisible }}>
      {children}

      {visible && (
        <div>
          <h1>Modal title</h1>
          <p>Modal Content</p>
        </div>
      )}
    </ModalContext.Provider>
  );
}
