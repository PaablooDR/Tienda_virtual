PGDMP                      |            PlateArt    16.1    16.1 4               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16527    PlateArt    DATABASE     }   CREATE DATABASE "PlateArt" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE "PlateArt";
                postgres    false            �            1259    16528    admin    TABLE     �   CREATE TABLE public.admin (
    email character varying(255) NOT NULL,
    password character varying(255),
    signature character varying(255)
);
    DROP TABLE public.admin;
       public         heap    postgres    false                       0    0    TABLE admin    ACL     0   REVOKE ALL ON TABLE public.admin FROM postgres;
          public          postgres    false    215            �            1259    16533    category    TABLE     p   CREATE TABLE public.category (
    code integer NOT NULL,
    name character varying(50),
    active boolean
);
    DROP TABLE public.category;
       public         heap    postgres    false                        0    0    TABLE category    ACL     3   REVOKE ALL ON TABLE public.category FROM postgres;
          public          postgres    false    216            �            1259    16536    category_code_seq    SEQUENCE     �   CREATE SEQUENCE public.category_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.category_code_seq;
       public          postgres    false    216            !           0    0    category_code_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.category_code_seq OWNED BY public.category.code;
          public          postgres    false    217            �            1259    16537    client    TABLE     �   CREATE TABLE public.client (
    email character varying(255) NOT NULL,
    telephone character varying(15),
    name character varying(50),
    surname character varying(50),
    password character varying(255),
    address character varying(255)
);
    DROP TABLE public.client;
       public         heap    postgres    false            "           0    0    TABLE client    ACL     1   REVOKE ALL ON TABLE public.client FROM postgres;
          public          postgres    false    218            �            1259    16542    product    TABLE     -  CREATE TABLE public.product (
    code character varying(255) NOT NULL,
    name character varying(100),
    description character varying(255),
    category integer NOT NULL,
    photo character varying(255),
    price numeric(10,2),
    stock integer,
    active boolean,
    outstanding boolean
);
    DROP TABLE public.product;
       public         heap    postgres    false            #           0    0    TABLE product    ACL     2   REVOKE ALL ON TABLE public.product FROM postgres;
          public          postgres    false    219            �            1259    16547    product_category_seq    SEQUENCE     �   CREATE SEQUENCE public.product_category_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.product_category_seq;
       public          postgres    false    219            $           0    0    product_category_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.product_category_seq OWNED BY public.product.category;
          public          postgres    false    220            �            1259    16548    shopping    TABLE     �  CREATE TABLE public.shopping (
    id_shopping integer NOT NULL,
    client character varying(255),
    shopping_date date DEFAULT CURRENT_DATE,
    status character varying(20),
    total_price numeric(10,2),
    CONSTRAINT shopping_status_check CHECK (((status)::text = ANY (ARRAY[('pending'::character varying)::text, ('sent'::character varying)::text, ('cart'::character varying)::text])))
);
    DROP TABLE public.shopping;
       public         heap    postgres    false            %           0    0    TABLE shopping    ACL     3   REVOKE ALL ON TABLE public.shopping FROM postgres;
          public          postgres    false    221            �            1259    16553    shopping_details    TABLE     �   CREATE TABLE public.shopping_details (
    id integer NOT NULL,
    shopping integer NOT NULL,
    product character varying(255),
    price_per_product numeric(10,2),
    amount integer,
    total_price numeric(10,2)
);
 $   DROP TABLE public.shopping_details;
       public         heap    postgres    false            &           0    0    TABLE shopping_details    ACL     ;   REVOKE ALL ON TABLE public.shopping_details FROM postgres;
          public          postgres    false    222            �            1259    16556    shopping_details_id_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_details_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.shopping_details_id_seq;
       public          postgres    false    222            '           0    0    shopping_details_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.shopping_details_id_seq OWNED BY public.shopping_details.id;
          public          postgres    false    223            �            1259    16557    shopping_details_shopping_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_details_shopping_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.shopping_details_shopping_seq;
       public          postgres    false    222            (           0    0    shopping_details_shopping_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.shopping_details_shopping_seq OWNED BY public.shopping_details.shopping;
          public          postgres    false    224            �            1259    16558    shopping_id_shopping_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_id_shopping_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.shopping_id_shopping_seq;
       public          postgres    false    221            )           0    0    shopping_id_shopping_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.shopping_id_shopping_seq OWNED BY public.shopping.id_shopping;
          public          postgres    false    225            h           2604    16559    category code    DEFAULT     n   ALTER TABLE ONLY public.category ALTER COLUMN code SET DEFAULT nextval('public.category_code_seq'::regclass);
 <   ALTER TABLE public.category ALTER COLUMN code DROP DEFAULT;
       public          postgres    false    217    216            i           2604    16560    product category    DEFAULT     t   ALTER TABLE ONLY public.product ALTER COLUMN category SET DEFAULT nextval('public.product_category_seq'::regclass);
 ?   ALTER TABLE public.product ALTER COLUMN category DROP DEFAULT;
       public          postgres    false    220    219            j           2604    16561    shopping id_shopping    DEFAULT     |   ALTER TABLE ONLY public.shopping ALTER COLUMN id_shopping SET DEFAULT nextval('public.shopping_id_shopping_seq'::regclass);
 C   ALTER TABLE public.shopping ALTER COLUMN id_shopping DROP DEFAULT;
       public          postgres    false    225    221            l           2604    16562    shopping_details id    DEFAULT     z   ALTER TABLE ONLY public.shopping_details ALTER COLUMN id SET DEFAULT nextval('public.shopping_details_id_seq'::regclass);
 B   ALTER TABLE public.shopping_details ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222            m           2604    16563    shopping_details shopping    DEFAULT     �   ALTER TABLE ONLY public.shopping_details ALTER COLUMN shopping SET DEFAULT nextval('public.shopping_details_shopping_seq'::regclass);
 H   ALTER TABLE public.shopping_details ALTER COLUMN shopping DROP DEFAULT;
       public          postgres    false    224    222                      0    16528    admin 
   TABLE DATA           ;   COPY public.admin (email, password, signature) FROM stdin;
    public          postgres    false    215   u:                 0    16533    category 
   TABLE DATA           6   COPY public.category (code, name, active) FROM stdin;
    public          postgres    false    216   �:                 0    16537    client 
   TABLE DATA           T   COPY public.client (email, telephone, name, surname, password, address) FROM stdin;
    public          postgres    false    218   �:                 0    16542    product 
   TABLE DATA           n   COPY public.product (code, name, description, category, photo, price, stock, active, outstanding) FROM stdin;
    public          postgres    false    219   ;                 0    16548    shopping 
   TABLE DATA           [   COPY public.shopping (id_shopping, client, shopping_date, status, total_price) FROM stdin;
    public          postgres    false    221   -E                 0    16553    shopping_details 
   TABLE DATA           i   COPY public.shopping_details (id, shopping, product, price_per_product, amount, total_price) FROM stdin;
    public          postgres    false    222   JE       *           0    0    category_code_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.category_code_seq', 5, true);
          public          postgres    false    217            +           0    0    product_category_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.product_category_seq', 1, false);
          public          postgres    false    220            ,           0    0    shopping_details_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.shopping_details_id_seq', 1, false);
          public          postgres    false    223            -           0    0    shopping_details_shopping_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.shopping_details_shopping_seq', 1, false);
          public          postgres    false    224            .           0    0    shopping_id_shopping_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.shopping_id_shopping_seq', 1, false);
          public          postgres    false    225            p           2606    16565    admin admin_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (email);
 :   ALTER TABLE ONLY public.admin DROP CONSTRAINT admin_pkey;
       public            postgres    false    215            r           2606    16567    category category_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (code);
 @   ALTER TABLE ONLY public.category DROP CONSTRAINT category_pkey;
       public            postgres    false    216            t           2606    16569    client client_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.client DROP CONSTRAINT client_pkey;
       public            postgres    false    218            v           2606    16571    product product_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (code);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            postgres    false    219            z           2606    16573 &   shopping_details shopping_details_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_pkey;
       public            postgres    false    222            x           2606    16575    shopping shopping_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_pkey PRIMARY KEY (id_shopping);
 @   ALTER TABLE ONLY public.shopping DROP CONSTRAINT shopping_pkey;
       public            postgres    false    221            {           2606    16576    product product_category_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_category_fkey FOREIGN KEY (category) REFERENCES public.category(code);
 G   ALTER TABLE ONLY public.product DROP CONSTRAINT product_category_fkey;
       public          postgres    false    4722    219    216            |           2606    16581    shopping shopping_client_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_client_fkey FOREIGN KEY (client) REFERENCES public.client(email);
 G   ALTER TABLE ONLY public.shopping DROP CONSTRAINT shopping_client_fkey;
       public          postgres    false    4724    218    221            }           2606    16586 .   shopping_details shopping_details_product_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_product_fkey FOREIGN KEY (product) REFERENCES public.product(code);
 X   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_product_fkey;
       public          postgres    false    4726    222    219            ~           2606    16591 /   shopping_details shopping_details_shopping_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_shopping_fkey FOREIGN KEY (shopping) REFERENCES public.shopping(id_shopping);
 Y   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_shopping_fkey;
       public          postgres    false    222    4728    221                  x�KL����L�1~\1z\\\ E��         C   x�3�t���M�)�,�2�tK�+I,���9�s3�ҁLN�ļ�D5��T ߔ�7�,3�#F��� ���            x������ � �         
  x��X�r�8=�_��\D�k�r,���c��&���*�"	@�D}}�Lp�����m�,�C./_b]|�4�n���6щ����i]<52K,I��Κb'++}�6���4[���]!��u����v�����&u\��֭��?˝�]|���O���f=(���)�ֽxL��ҷkd�K�+i`���o�&�S�hO�6�V�V��E�%_2�SE%/U%n+:��â|6U*�t��ii�r�T���˭ux��P������A�©�c6�z}7�٥�w�U&�w�k]�'�$_�7�/U�)&Ng�e
Y8��c��XE�)ܭ�ej�'yo���F���>:�K��.*E% ��Ғk�D�u��4�IeS����l�t�����W�E�)��l� l����Ef�>.��b��TTj
^V[WR�khm���6�z6YC8�����k'����&`qq۳Ω��7K����A%�hܺ{�U�y^L:�<�v�����O#�4Y"
��᨟u���==JĠH|�M1V���T��lz[����)dk�����шG��.�*�Ϛ�xXچ%��Ds�ږ���9�[Qq���A���lu���;���d���e�LCxB\B�])�Q��
�1?t��M�d\v��X�F�vo�����6����6�ѕW��0���}Ja�V�u	�#�r�3��+)VY�g/5�����w�zV�v[����1�G7���佑	�j�� w]�`����Q�����"�>`�����*n��qEA�),��u=u�!Q.�	����.��9�YF�N<R���oH`��y���"��(�[���(��[�r����$�Y�>���4;]�qM�$0�P��.]E?��ac�S0}�R\S��N'��2�>$\��'�R�y%���Pr��BD�3X:���2���F(`�7�� O�;+��Mm���X��h1�	L�m�ړt�Hpi����	������!��)O�,�-�m`u-?g
=����#{b9ZN���8Gr<(F�3����1�Q�luԺ��P�rg\6Y4�&�xp�Y��<z �So�k#�ʩ����o(ߵ��1�~��3��T�9swVRM��O�E�>A���G(>v�l��d\3���<��[�x���@SEt�cbf�dOƹ׊�	�,��Y2�k&�ߕ�]�'�`k���!�
�Ǆ8r.�l��j��:^n�-�qm�X{E}2%"sޠ�l���1�zT�y���/ef��C> ���d�S$7[�9�ThCV��E�|q�x����lq�Jr1'"y����������
��䖣�+2N��;�C�Lz1l����[���4+��i�r>��FY�d[l(��k�d��v��BW}��y����!(���b��RR���>�V� ���,�-�eR��t*�� �ҟ����쿋���R\ц[���n�H���� �[����Ĝ��i�B�҂c'p�:��ӑ|�c�=Ĺ��hߡT��T7�%��d�J�7��-I�\�e���?����S�!�Sq�oj�n������*�#�^�*�Һ
���ޜh
�Y� ������3�奄�a����T�Sb�F�O�3x;$�(C��y��zǔ}mŵ}��g&<�C͓��}P�QD���F�ā�)_�B�Ȓ��D{s���З%��z���%�5�׳��S������_�un�=FRJ����yz�0y�>.���
��*���
������'�2�����$0��`�\\ZJ�:�'6*t��/�cʃ��iM+��n�YIw�O��]�%X��(݌���)f�)B&/[���$�bD�A�`h�<�1���r���v\B���4�Р%V��kQ/3�.N{|�n޾��qzD���&QM��9�C8r��)��85z�j�jw
鼿�8���t�(q�jj佭H�|)�w�;��`�|zcw(�ʏ ���S['�&��l�ܱ=�0��BN�F�ep�2H�ĨBɯ$�ޯ>��Ajwv���f���C ���ep�*���Wґ%m�,Y�P����e[���I�ȸͩ|K	]Y^��6h��h�6���f��}����)��{���Q�[� �>�%�m�"��U킼�g�I� w<-қ��Έ;�^��mϠ���-��Q:Ot	���j����{~��>����:+k�#P)J��)G(���Aԯxl�G�FR��6� E��hav���%�5__\݊�۫�qX�K����0�썫j���q�ݛa����L1���j��22��E?�,�k%��k�ݭ��AS��ڙ6�5F��j�3�����������hb<�����E��2��l����L�#��ю�)˴{�E߲C���ֱS�J��Cכ�$[2��N�^�S��le�Z,��G�V��'�[Ed5�!l����
��<O��MC�.F� �,��{(L�ߴ��t��s�ޝ���-����M$4�2�(��
x��@W.S(.�˦ �f��\���dtG����6�9q���5<5<h�_�ȋ~��T\�9%����Ç�m��            x������ � �            x������ � �     